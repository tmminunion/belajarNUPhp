<?php

function tolink($url)
{
    header("Location: " . getBaseUrl() . $url);
    exit;
}
function to_url($url)
{
    // hapus token csrf saja
    unset($_SESSION['token_csrf']);
    header("Location: " . getBaseUrl() . $url);
    exit;
}
function Component($component, $variables = [])
{
    $templateEngine = new SimpleTemplateEngine\Template();
    echo $templateEngine->ComponentView($component, $variables);
}

function Components($file, $data = [])
{
    $theme = new SimpleTemplateEngine\Environment('views/components');
    echo $theme->render($file . '.php', $data);
}


function last_form()
{
    $_SESSION['last_form'] = $_SERVER['REQUEST_URI'];
}
function get_last_form()
{
    return $_SESSION['last_form'];
}

function vPost(array $keys)
{
    foreach ($keys as $key) {
        if (empty($_POST[$key]) || $_POST[$key] === null) {
            to_url(get_last_form() . "?eror=nullelement");
            exit();
        }
    }
}
