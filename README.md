# Тестовое задание

## Реализованные endpoints

### Регистрация
- **URL:** `http://127.0.0.1:80/api/registration`
- **Метод:** `POST`
- **Авторизация:** Не требуется
- **Параметры:**
  - `email` (string, required)
  - `password` (string, required, min:6)
  - `password_confirmation` (string, required)
  - `gender` (string, required, in:male,female)
- **Описание:** Регистрирует пользователя в системе

### Профиль
- **URL:** `http://127.0.0.1:80/api/profile`
- **Метод:** `GET`
- **Авторизация:** Требуется (Bearer Token)
- **Описание:** Выводит информацию об авторизованном пользователе

## Поднятие проекта

1. Клонируем репозиторий:
   ```bash
   git clone https://github.com/RayzOnePy/Jeleapps-task.git
   cd Jeleapps-task
   ```

2. Запускаем Docker окружение:
   ```bash
   docker compose up -d --build
   ```

3. Заходим в контейнер:
   ```bash
   docker compose exec app bash
   ```

4. Выполняем миграции:
   ```bash
   php artisan migrate
   ```

Postman коллекция находиться в папке collection в корне приложения
