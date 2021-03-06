<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200;0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet"> 

        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Black+Ops+One&display=swap" rel="stylesheet">

        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">

        <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
        <!-- axios -->
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <title>Dissing - {{$title}}</title>
    </head>
    <body style="font-family: 'Black Ops one' !important"> 
        <style>
            button {
                font-family: 'Black Ops one';
            }
            label {
                font-family: 'Black Ops one';
            }
            input {
                font-family: 'Black Ops one';
            }
        </style>
        <div id="app" style="font-family: Black Ops one;">
            <v-app style="background-color: #455A64;">
                <v-main>

                @include('navbar')

                <v-container>
                    @include($page)
                </v-container>

                </v-main>
            </v-app>
        </div>
        @yield('vue')

        @include('footer')

        @include('scripts')
        
    </body>
</html>