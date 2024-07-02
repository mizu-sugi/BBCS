<!DOCTYPE html>
<html lang="ja">
<head>
    <title>@yield('title', '')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="/css/tailwind/tailwind.min.css">

    <link rel="icon" type="image/png" sizes="16x16" href="/favicon.png">
    <script src="/js/main.js"></script>
</head>
<body class="antialiased bg-body text-body font-body">

<!-- ▼▼▼▼共通ヘッダー▼▼▼▼　-->
<header>
    <div class="px-4 mx-auto bg-gray-800">
        <nav class="flex items-center justify-between py-6">
            <a class="text-3xl font-semibold leading-none text-white" href="/">BBCA</a>
            <ul class="hidden lg:flex ml-auto mr-12 space-x-12">
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="#"></a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="#"></a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="/blogs"></a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="#"></a></li>
                <li><a class="text-sm text-blueGray-400 hover:text-blueGray-500" href="#"></a></li>
            </ul>
            <div>
                <a class="mr-2 inline-block px-4 py-3 text-xs text-white hover:text-purple-400 leading-none border border-blue-200 hover:border-blue-300 rounded" href="/members/login">Log In</a>
                <a class="inline-block px-4 py-3 text-xs font-semibold leading-none bg-purple-500 hover:bg-purple-400 text-white rounded" href="/members/users/create">Sign Up</a>
            </div>
        </nav>
    </div>
</header>
<!-- ▲▲▲▲共通ヘッダー▲▲▲▲　-->

<!-- ▼▼▼▼ページ毎の個別内容▼▼▼▼　-->
<main>
@yield('content')
</main>
<!-- ▲▲▲▲ページ毎の個別内容▲▲▲▲　-->

<!-- ▼▼▼▼共通フッター▼▼▼▼　-->
<footer class="bg-black">
    <div class="px-4 container mx-auto p-10 flex justify-between">
        <div class="text-white text-left">
            <h2 class="text-xl font-semibold">Blessed To be a Breast Cancer Survivor!</h2>

        </div>

        <ul class="text-white text-left hidden md:flex flex-wrap flex-col h-12 md:w-128">
            <li class="ml-6"><a href="/" class="hover:underline"></a></li>
            <li class="ml-6"><a href="#" class="hover:underline"></a></li>
            <li class="ml-6"><a href="#" class="hover:underline"></a></li>
            <li class="ml-auto"><a href="/admin/login" class="hover:underline">Admin</a></li>

        </ul>
    </div>
</footer>
<!-- ▲▲▲▲共通フッター▲▲▲▲　-->
</body>
</html>

