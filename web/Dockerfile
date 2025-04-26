FROM oven/bun:1.1

WORKDIR /app

COPY . ./

RUN apt-get update && apt-get install -y curl && rm -rf /var/lib/apt/lists/*

COPY ./scripts/bun-entrypoint /usr/local/bin/bun-entrypoint
RUN chmod +x /usr/local/bin/bun-entrypoint

EXPOSE 3000

ENTRYPOINT ["/usr/local/bin/bun-entrypoint"]

CMD ["bun", "run", "start"]
