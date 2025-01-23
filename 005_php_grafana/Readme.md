# About experiment
Setup chain php-app -> prometheus -> grafana.

At php-app, we have a simple php app that exposes a metric /metrics. Custom metric free_disk_space is added to the app.

Prometheus scrapes the metric from php-app and stores it.

Grafana visualizes the metric from Prometheus at predefined dashboard.

Check grafana/provisioning/* for base configuration.
Dashboard was created manually and then exported to JSON grafana/dashboards/simple-dashboard.json.

# Tech details

## Build

make build

## Run

make up

## Check

**PHP App**: http://localhost:8080

**Prometheus**: http://localhost:9090

curl "http://localhost:9090/api/v1/query?query=up"

**Grafana**: http://localhost:3000
Credentials: admin@12345

## Set Up Grafana manually
Grafana will connect to Prometheus to visualize the metrics:

1. Access Grafana at http://localhost:3000.
Login using the default credentials:
Username: admin
Password: 12345

2. Add Prometheus as a data source:
Navigate to Connections > Data Sources.
Click Add data source and choose Prometheus.
Enter the URL: http://prometheus:9090 (the service name prometheus defined in docker-compose.yml).
Click Save & Test to verify the connection.
