<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-gray-100{--bg-opacity:1;background-color:#f7fafc;background-color:rgba(247,250,252)}.flex{display:flex}.justify-center{justify-content:center}.min-h-screen{min-height:100vh}.py-4{padding-top:1rem;padding-bottom:1rem}.relative{position:relative}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}@media (min-width:640px){.sm\:items-center{align-items:center}.sm\:pt-0{padding-top:0}}@media (prefers-color-scheme:dark){.dark\:bg-gray-900{--bg-opacity:1;background-color:#1a202c;background-color:rgba(26,32,44)}}
        </style>

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
            .pagination, .nav-menu {
                padding: 0;
                list-style: none;
                display: inline-flex;
                align-items: center;
                margin: 0 -5px;
            }
            .pagination__item, .nav-item {
                padding: 0 5px;
                flex-shrink: 0;
            }
            .pagination__link.is-active, .nav-link.is-active {
                color: #f24942;
                border-color: #f24942;
            }
            .pagination__link, .nav-link {
                padding: 0 5px;
                display: block;
                font-size: .875rem;
                font-weight: 700;
                color: #929292;
                border-bottom: 2px solid transparent;
                transition: .3s;
                text-decoration: none;
            }

            .table-scroll{
                width:100%;
                display: block;
                empty-cells: show;

            }

            .table-scroll thead{
                background-color: #f1f1f1;
                position:relative;
                display: block;
                width:100%;
            }

            .table-scroll tbody{
                /* Position */
                display: block;
                position:relative;
                width:100%;
                overflow-y:scroll;
                /* Decoration */
                border-top: 1px solid rgba(0,0,0,0.2);
            }

            .table-scroll tr{
                width: 100%;
                display:flex;
            }

            .table-scroll td,.table-scroll th{
                flex-basis:100%;
                flex-grow:2;
                display: block;
                padding: 1rem;
                text-align:left;
            }

            /* Other options */

            .table-scroll.small-first-col td:first-child,
            .table-scroll.small-first-col th:first-child{
                flex-basis:20%;
                flex-grow:1;
            }

            .table-scroll tbody tr:nth-child(2n){
                background-color: rgba(130,130,170,0.1);
            }

            .body-screen{
                max-height: 80vh;
            }

            .small-col{flex-basis:10%;}
        </style>
    </head>
    <body class="antialiased">

        <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
            <form action="{{ route('employes.import') }}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label for="file" class="control-label">Файл для импорта</label>
                    <input class="form-control"
                           accept="text/xml" id="import"
                           name="import" type="file">
                    <span class="help-block">Файл должен быть в формате <b>*.xml</b></span>
                </div>
                <button type="submit" class="btn btn-flat bg-olive margin ">Импортировать</button>
            </form>
        </div>
    </body>
</html>
