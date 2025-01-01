<?php
//this line does: we are expecting json and we should be able to work with Cyrillic script
header('Content-Type: application/json; charset=utf-8');

// chekc if input data is given as json or as http post
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// if there isn;t valid json - use post
if (json_last_error() !== JSON_ERROR_NONE || empty($data)) {
    $data = $_POST;
}

// keep in mind that $_POST returns an array
$name = $data['name'] ?? '';
$teacher = $data['teacher'] ?? '';
$description = $data['description'] ?? '';
$group = $data['group'] ?? '';
$credits = $data['credits'] ?? 0;

$validGroups = ['М', 'ПМ', 'ОКН', 'ЯКН'];
$errors = [];

if (empty($name)) {
    $errors['name'] = "Името на учебния предмет е задължително поле.";
} elseif (mb_strlen($name) < 2) {
    $errors['name'] = "Името на учебния предмет трябва да съдържа поне 2 символа. Въведени са: " . mb_strlen($name) . " символа.";
} elseif (mb_strlen($name) > 150) {
    $errors['name'] = "Името на учебния предмет не може да надвишава 150 символа. Въведени са: " . mb_strlen($name) . " символа.";
}

if (empty($teacher)) {
    $errors['teacher'] = "Името на преподавателя е задължително поле.";
} elseif (mb_strlen($teacher) < 3) {
    $errors['teacher'] = "Името на преподавателя трябва да съдържа поне 3 символа. Въведени са: " . mb_strlen($teacher) . " символа.";
} elseif (mb_strlen($teacher) > 200) {
    $errors['teacher'] = "Името на преподавателя не може да надвишава 200 символа. Въведени са: " . mb_strlen($teacher) . " символа.";
}

if (empty($description)) {
    $errors['description'] = "Описанието е задължително поле.";
} elseif (mb_strlen($description) < 10) {
    $errors['description'] = "Описанието трябва да съдържа поне 10 символа. Въведени са: " . mb_strlen($description) . " символа.";
}

if (empty($group)) {
    $errors['group'] = "Групата е задължително поле.";
} elseif (!in_array($group, $validGroups)) {
    $errors['group'] = "Невалидна група. Изберете една от М, ПМ, ОКН и ЯКН.";
}

if (empty($credits)) {
    $errors['credits'] = "Кредитите са задължително поле.";
} elseif (!is_numeric($credits)) {
    $errors['credits'] = "Кредитите трябва да бъдат число.";
} elseif ($credits <= 0) {
    $errors['credits'] = "Кредитите трябва да бъдат положително число.";
}

// this is how you return a result in php
// using "JSON_UNESCAPED_UNICODE" so the output it's readable in the terminal 
if (!empty($errors)) {
    echo json_encode([
        "success" => false,
        "errors" => $errors
    ], JSON_UNESCAPED_UNICODE); 
} else {
    echo json_encode([
        "success" => true
    ], JSON_UNESCAPED_UNICODE);
}
?>
