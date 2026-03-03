# R606_eval

Copier le fichier d'environnement de développement :
```bash
cp .env.example .env.development
```

Lancer le projet avec docker-compose :
```bash
docker compose --env-file .env.development -f docker-compose.dev.yml up --build
```

Appliquer les migrations :
```bash
php bin/doctrine migrations:migrate
```

Lancer les tests :
```bash
php bin/phpunit
```

### Notes
- Je n'ai pas eu le temps de run les tests dans la CI