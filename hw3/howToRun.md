# Как да изпробвате проекта?
1. Стартирайте XAMPP:

2. Уверете се, че Apache е стартиран.
Поставете файловете в XAMPP папката:

3. Създайте папка в htdocs (например project) и сложете файловете вътре.
Достъп до HTML формата:

4. Отворете браузъра и въведете: http://localhost/project/index.html.

5. Изпращане на JSON чрез curl:

6. Отворете терминал и изпълнете:
```bash
bash:curl -X POST -H "Content-Type: application/json" -d @hw3/example.json http://localhost/demo/hw3/validate.php
```