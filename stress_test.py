#!/usr/bin/env python3
"""
Suite de Pruebas de Carga y Estrés - Sistema Escolar Colegio
Ejecución: python3 stress_test.py --url http://localhost:8080 --users 25 --duration 30
"""

import argparse
import concurrent.futures
import json
import statistics
import time
import urllib.error
import urllib.parse
import urllib.request


def make_request(url, data=None, method="GET", cookie=None):
    headers = {
        "User-Agent": "StressTestRunner/1.0",
    }
    if cookie:
        headers["Cookie"] = cookie

    encoded_data = None
    if data:
        encoded_data = urllib.parse.urlencode(data).encode("utf-8")
        headers["Content-Type"] = "application/x-www-form-urlencoded"

    req = urllib.request.Request(
        url, data=encoded_data, headers=headers, method=method
    )
    start = time.perf_counter()
    try:
        with urllib.request.urlopen(req, timeout=10) as response:
            body = response.read()
            latency = (time.perf_counter() - start) * 1000
            return {
                "status": response.status,
                "latency_ms": latency,
                "size_bytes": len(body),
                "error": None,
            }
    except urllib.error.HTTPError as e:
        latency = (time.perf_counter() - start) * 1000
        return {
            "status": e.code,
            "latency_ms": latency,
            "size_bytes": 0,
            "error": f"HTTP {e.code}",
        }
    except Exception as e:
        latency = (time.perf_counter() - start) * 1000
        return {
            "status": 0,
            "latency_ms": latency,
            "size_bytes": 0,
            "error": str(e),
        }


def run_benchmark(base_url, concurrency, duration_sec):
    print(f"\n========================================================")
    print(f" Iniciando Prueba de Estrés: Sistema Colegio")
    print(f" URL Base: {base_url}")
    print(f" Usuarios concurrentes: {concurrency}")
    print(f" Duración: {duration_sec} segundos")
    print(f"========================================================\n")

    endpoints = [
        {"path": "/index.html", "method": "GET", "data": None, "weight": 20},
        {
            "path": "/controlador/usuario.php?op=verificar",
            "method": "POST",
            "data": {"nombreUsu": "30051282", "clave": "12345"},
            "weight": 25,
        },
        {
            "path": "/controlador/noticia.php?op=listar",
            "method": "GET",
            "data": None,
            "weight": 20,
        },
        {
            "path": "/controlador/evento.php?op=listar",
            "method": "GET",
            "data": None,
            "weight": 15,
        },
        {
            "path": "/controlador/recurso.php?op=listar",
            "method": "GET",
            "data": None,
            "weight": 20,
        },
    ]

    all_results = []
    end_time = time.time() + duration_sec
    request_counter = 0

    def worker(worker_id):
        nonlocal request_counter
        local_results = []
        i = 0
        while time.time() < end_time:
            ep = endpoints[i % len(endpoints)]
            target_url = base_url.rstrip("/") + ep["path"]
            res = make_request(target_url, data=ep["data"], method=ep["method"])
            res["endpoint"] = ep["path"].split("?")[0]
            local_results.append(res)
            request_counter += 1
            i += 1
            time.sleep(0.01)  # Pequeño jitter
        return local_results

    start_total = time.time()
    with concurrent.futures.ThreadPoolExecutor(
        max_workers=concurrency
    ) as executor:
        futures = [executor.submit(worker, i) for i in range(concurrency)]
        for f in concurrent.futures.as_completed(futures):
            all_results.extend(f.result())

    total_time = time.time() - start_total

    # Métricas y reporte
    total_reqs = len(all_results)
    if total_reqs == 0:
        print("No se pudieron registrar peticiones. Verifica la conexión.")
        return

    successes = [r for r in all_results if 200 <= r["status"] < 400]
    failures = [r for r in all_results if r["status"] >= 400 or r["status"] == 0]
    latencies = [r["latency_ms"] for r in all_results]

    latencies.sort()
    avg_latency = statistics.mean(latencies)
    p50 = statistics.median(latencies)
    p90 = latencies[int(len(latencies) * 0.90)]
    p95 = latencies[int(len(latencies) * 0.95)]
    p99 = latencies[int(len(latencies) * 0.99)]
    rps = total_reqs / total_time

    print("\n---------------- RESULTADOS DE RENDIMIENTO ----------------")
    print(f" Peticiones Totales:       {total_reqs}")
    print(
        f" Exitosas (2xx/3xx):       {len(successes)} ({(len(successes)/total_reqs)*100:.1f}%)"
    )
    print(
        f" Fallidas (4xx/5xx/Error): {len(failures)} ({(len(failures)/total_reqs)*100:.1f}%)"
    )
    print(f" Throughput (RPS):         {rps:.2f} peticiones/segundo")
    print(f" Tiempo Total de Ejecución:{total_time:.2f}s")
    print("\n---------------- LATENCIA DE RESPUESTA (ms) ----------------")
    print(f" Mínima:                   {min(latencies):.2f} ms")
    print(f" Promedio:                 {avg_latency:.2f} ms")
    print(f" Mediana (p50):            {p50:.2f} ms")
    print(f" Percentil 90 (p90):       {p90:.2f} ms")
    print(f" Percentil 95 (p95):       {p95:.2f} ms")
    print(f" Percentil 99 (p99):       {p99:.2f} ms")
    print(f" Máxima:                   {max(latencies):.2f} ms")
    print("-----------------------------------------------------------\n")

    if failures:
        sample_errors = list({f["error"] for f in failures if f["error"]})[:5]
        print(f" Errores más frecuentes: {sample_errors}\n")


if __name__ == "__main__":
    parser = argparse.ArgumentParser(
        description="Suite de Estrés para Sistema Colegio"
    )
    parser.add_argument(
        "--url", default="http://localhost:8080", help="URL base del servidor"
    )
    parser.add_argument(
        "--users", type=int, default=20, help="Número de usuarios concurrentes"
    )
    parser.add_argument(
        "--duration",
        type=int,
        default=15,
        help="Duración de la prueba en segundos",
    )
    args = parser.parse_args()

    run_benchmark(args.url, args.users, args.duration)
