<?php
$lang = $_COOKIE['lang'] ?? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

if (!in_array($lang, ['en', 'ru'])) {
  $lang = 'en';
}

if ($_GET['lang'] && in_array($_GET['lang'], ['en', 'ru'])) {
  $lang = $_GET['lang'];
  setcookie('lang', $lang, [
    'expires'  => time() + 86400,
    'path'     => '/',
    'secure'   => true,
    'httponly' => true,
    'samesite' => 'Lax',
  ]);
}

$langs = [
  'en' => 'English',
  'ru' => 'Русский',
];

$appNameEn = 'Paintle';
$appNameRu = 'Пейнтли';

$translations = [
  'title' => [
    'en' => "$appNameEn - Worlde solution painter app",
    'ru' => "$appNameRu - приложение для рисования решений для Вордли",
  ],
  'description' => [
    'en' => 'Draw the Wordle solution you want to have, and this application will generate Wordle inputs that will give your drawing.',
    'ru' => 'Нарисуйте такое решение Вордли, которое хотите, и это приложение сгенерирует слова для Вордли, которые выдадут ваш рисунок.',
  ],
  'appName' => [
    'en' => $appNameEn,
    'ru' => $appNameRu,
  ],
  'langSwitcher' => [
    'en' => 'Change language',
    'ru' => 'Смена языка'
  ],
  'darkmodeTooltip' => [
    'en' => 'Dark mode switcher',
    'ru' => 'Темная тема',
  ],
  'githubLinkTooltip' => [
    'en' => 'Star me on GitHub',
    'ru' => 'Поставь звездочку на GitHub',
  ],
  'wordleSolutionText' => [
    'en' => 'Enter today\'s Wordle solution',
    'ru' => 'Введите сегодняшнее решение Wordle',
  ],
  'wordlistLanguageSelectionText' => [
    'en' => 'Select Wordle language',
    'ru' => 'Выберите язык Wordle',
  ],
  'wordlistLanguageEn' => [
    'en' => 'English: (www.nytimes.com)',
    'ru' => 'Английский: (www.nytimes.com)',
  ],
  'wordlistLanguageRu' => [
    'en' => 'Russain: (wordle.belousov.one)',
    'ru' => 'Русский: (wordle.belousov.one)',
  ],
  'wordlistLanguageCustom' => [
    'en' => 'Upload your own wordlist',
    'ru' => 'Загрузите ваш словарь',
  ],
  'wordlistInputText' => [
    'en' => 'Wordlist must be either',
    'ru' => 'Словарь должен быть',
  ],
  'wordlistInputJson' => [
    'en' => 'JSON object must be array only with words',
    'ru' => 'JSON объект должен быть массив слов',
  ],
  'wordlistInputOr' => [
    'en' => 'or',
    'ru' => 'или',
  ],
  'wordlistInputTxt' => [
    'en' => 'Each word must be on a separate line',
    'ru' => 'Каждое слово обязано быть на отдельной строчке',
  ],
  'wordlistInputUpload' => [
    'en' => 'Upload your custom wordlist',
    'ru' => 'Загрузите ваш пользовательский словарь',
  ],
  'mainText' => [
    'en' => 'Paint solution you want to have',
    'ru' => 'Нарисуйте решение которое вам нарвится',
  ],
  'colorPickerText' => [
    'en' => 'Pick a color',
    'ru' => 'Выберите цвет',
  ],
  'colorblindMode' => [
    'en' => 'Colorblind mode',
    'ru' => 'Режим дальтоника',
  ],
  'solveButton' => [
    'en' => 'Solve',
    'ru' => 'Решить',
  ],
  'footerSourceCode' => [
    'en' => 'Source code',
    'ru' => 'Исходный код',
  ],
  'footerLicense' => [
    'en' => 'License',
    'ru' => 'Лицензия',
  ],
];

function i18n(string $text): string {
  global $lang;
  global $translations;
  return $translations[$text][$lang];
}
?>

<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
  <title><?= i18n('title') ?></title>

  <link rel="icon" type="image/x-icon" sizes="50x50" href="/favicon.ico">
  <link rel="canonical" href="https://paintle.strongleong.ru">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="<?= i18n('description') ?>">
  <meta name="og:title" property="og:title" content="<?= i18n('title') ?>">
  <meta name="og:description" property="og:description" content="<?= i18n('description') ?>">
  <meta name="og:image" property="og:image" content="https://paintle.strongleong.ru/img/logo.png">
  <meta name="og:url" property="og:url" content="https://paintle.strongleong.ru">
  <meta name="og:type" property="og:type" content="website">
  <meta name="robots" content="index, nofollow">

  <link href="css/style.css" rel="stylesheet">
  <link href="css/nerdfonts.css" rel="stylesheet">
</head>

<body>
  <header>
    <select title="<?= i18n('langSwitcher') ?>" id="lang-switcher">
      <?php foreach($langs as $key => $label) { ?>
        <option value="<?= $key ?>" <?= $lang === $key ? 'selected' : '' ?>><?= $label ?></option>
      <?php } ?>
    </select>

    <h1><?= i18n('appName') ?></h1>

    <div class="icons">
      <i title="<?= i18n('darkmodeTooltip') ?>" id="dark-mode" class="nf nf-oct-moon"></i>
      <a title="<?= i18n('githubLinkTooltip') ?>" id="github-link" rel="nofollow" target="_blank" href="https://github.com/strongleong/paintle"
        class="nf nf-md-github"></a>
    </div>
  </header>

  <div class="content flex flex-col">
    <section class="block flex flex-col">
      <h3><?= i18n('wordleSolutionText') ?></h3>
      <input id="solution" type="text" placeholder="pasta" maxlength="5" />
    </section>

    <section class="block flex flex-col">
      <h3 id="heading-language"><?= i18n('wordleSolutionText') ?></h3>

      <select id="language">
        <option id="wordlist-lang-en" value="en">
          <?= i18n('wordlistLanguageEn') ?>
        </option>

        <option id="wordlist-lang-ru" value="ru">
          <?= i18n('wordlistLanguageRu') ?>
        </option>

        <option id="wordlist-lang-custom" value="own">
          <?= i18n('wordlistLanguageCustom') ?>
        </option>
      </select>
    </section>

    <section class="block nodisplay flex flex-col" id="wordlist-input-block">
      <div id="wordlist-input-heading" class="row"><?= i18n('wordlistInputText') ?></div>

      <div class="row wordlist-hint">
        <div class="grid">

          <h4>JSON</h4>
          <div></div>
          <h4>TXT</h4>

          <div><?= i18n('wordlistInputJson') ?></div>
          <div class="or"><?= i18n('wordlistInputOr') ?></div>
          <div><?= i18n('wordlistInputTxt') ?></div>

          <code>
            <div class="paren">[</div>
            <div class="string">"word1",</div>
            <div class="string">"word2",</div>
            <div class="string">"word3"</div>
            <div class="paren">]</div>
          </code>
          <div></div>
          <code>
            <div>word1</div>
            <div>word2</div>
            <div>word3</div>
          </code>
        </div>
      </div>

      <button id="wordlist-upload"><?= i18n('wordlistInputUpload') ?></button>
      <input type="file" accept=".json,.txt" id="wordlist-input" class="nodisplay" />
      <div id="wordlist-error" class="error"></div>

    </section>

    <main id="board" class="block flex flex-col">
      <h2><?= i18n('mainText') ?></h2>

      <div class="row flex">
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
      </div>

      <div class="row flex">
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
      </div>

      <div class="row flex">
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
      </div>

      <div class="row flex">
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
      </div>

      <div class="row flex">
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
      </div>

      <div class="row flex">
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
        <div class="cell noselect"></div>
      </div>
    </main>

    <section class="block flex flex-col">
      <h3><?= i18n('colorPickerText') ?></h3>

      <div class="row flex pallete">
        <div class="cell noselect correct active" id="correct"></div>
        <div class="cell noselect present" id="present"></div>
        <div class="cell noselect absent" id="absent"></div>
      </div>
    </section>

    <section class="block">
      <label class="toggle">
        <input class="toggle-checkbox" type="checkbox" id="colorblind-mode">
        <div class="toggle-switch"></div>
        <span class="toggle-label"><?= i18n('colorblindMode') ?></span>
      </label>
    </section>

    <section class="row flex">
      <button id="solve"><?= i18n('solveButton') ?></button>
    </section>
  </div>

  <footer class="row flex">
      <a title="<?= i18n('githubLinkTooltip') ?>" class="footer-link" rel="nofollow" href="https://github.com/strongleong/paintle"><?= i18n('footerSourceCode') ?></a>
      <a title="MIT" class="footer-link" rel="nofollow" href="https://github.com/Strongleong/Paintle/blob/master/LICENSE"><?= i18n('footerLicense') ?></a>
  </footer>
</body>

<script defer src="scripts/script.js"></script>

</html>
