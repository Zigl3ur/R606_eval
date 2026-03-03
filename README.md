# R606_eval

Copier le fichier d'environnement de développement :
```bash
cp .env.example .env.development
```

Lancer le projet avec docker-compose :
```bash
docker compose --env-file .env.development -f docker-compose.dev.yml up --build
```