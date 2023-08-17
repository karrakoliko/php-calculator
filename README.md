PHP калькулятор

Выполнено в рамках тестового задания.

## Запуск

### Через docker:
1. ```sudo docker build -t karrakoliko/php-calculator . && sudo docker run -p NEEDED_PORT:8000 -d -it karrakoliko/php-calculator```
2. Открыть в браузере ```http://localhost:NEEDED_PORT```

#### Остановить контейнер:
```sudo docker stop $(sudo docker ps -a -q --filter=ancestor="karrakoliko/php-calculator")```

### Через локально установленный php и symfony-cli:
1. Установить зависимости ```composer install``` 
2. Запустить symfony dev server ```symfony serve```
3. Открыть в браузере (symfony serve выдаст ссылку)