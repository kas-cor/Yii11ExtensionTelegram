# Yii11ExtensionTelegtam
Расширение Yii1.1 для отправки сообщений на Telegram
## Установка

Поместить файл в
```
/protected/extensions/telegram/Tlgm.php
```

Прописать в конфиге
```
...php
// application components
'components' => array(
    ...
    'telegram' => array(
        'class' => 'ext.telegram.Tlgm',
        'token' => '12345678:YoureBotToken',
    ),
    ...
),
...
```

## Получить ID пользователя

Для получения сообщений узнайте свой ID у бота [MyTelegramID_bot](https://telegram.me/MyTelegramID_bot)
## Использование

```php
Yii::app()->telegram->send("Message text");
```
