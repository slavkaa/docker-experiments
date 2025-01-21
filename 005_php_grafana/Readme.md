# Build

make build

# Run

make up

# Check

**PHP App**: http://localhost:8080

**Prometheus**: http://localhost:9090

curl "http://localhost:9090/api/v1/query?query=up"

**Grafana**: http://localhost:3000
Credentials: admin@admin

# Set Up Grafana
Grafana will connect to Prometheus to visualize the metrics:

1. Access Grafana at http://localhost:3000.
Login using the default credentials:
Username: admin
Password: admin

2. Add Prometheus as a data source:
Navigate to Connections > Data Sources.
Click Add data source and choose Prometheus.
Enter the URL: http://prometheus:9090 (the service name prometheus defined in docker-compose.yml).
Click Save & Test to verify the connection.
