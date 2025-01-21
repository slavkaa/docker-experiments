docker compose up -d
docker compose up --build -d

TEST 1:
curl -v --http1.0 http://localhost:8081
curl -v --http1.1 http://localhost:8082
curl -v --http2.0 http://localhost:8083

TEST 2:
curl -v --http1.0 http://localhost:8081 -o /dev/null -w "Time: %{time_total}s\n" -H "Connection: keep-alive"
curl -v --http1.0 http://localhost:8081 -o /dev/null -w "Time: %{time_total}s\n" -H "Connection: keep-alive"

curl -v --http1.1 http://localhost:8082 -o /dev/null -w "Time: %{time_total}s\n"
curl -v --http1.1 http://localhost:8082 -o /dev/null -w "Time: %{time_total}s\n"

tcp listener
sudo tcpdump -A -i any tcp port 8081 or tcp port 8082