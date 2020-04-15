<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio Sesion</title>

    <!-- Styles -->
    <link href="../../node_modules/css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="../../node_modules/vuetify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="main.css">
</head>

<body>

    <!-- App -->
    <div id="app">
        <v-app id="inspire">
            <v-row no-gutters>
                <v-col cols="12" sm="6">
                    <!-- Content -->
                    <v-container fluid class="pa-8 first">
                        <v-card class="" tile>
                            <!-- Images -->
                            <v-img src="../../Images/logo.png" aspect-ratio="2" contain></v-img>
                        </v-card>
                        <v-card class="" tile>
                            <!-- Images -->
                            <v-img src="../../Images/invenotry-grow.gif" aspect-ratio="2" contain></v-img>
                        </v-card>
                    </v-container>
                </v-col>
                <v-col cols="12" sm="6">
                    <v-container fluid class="pa-8" second>
                        <v-card class="title" color="#0a4e8f">
                            <!-- Images -->
                            <p>Bienvenido/a al tu sistema de gestion de inventario</p>
                        </v-card>

                        <v-card class="pa-8 mt-5">
                            <div class="cont">
                                <v-chip class="ma-2" color="#0a4e8f" label text-color="white">
                                    <v-icon class="mr-2">mdi-account</v-icon>
                                    Inicio de Sesion
                                </v-chip>
                            </div>
                            <template>
                                <v-col cols="12" sm="11">
                                    <v-form ref="form" v-model="valid" :lazy-validation="lazy">
                                        <v-text-field width="150" v-model="name" :counter="25" :rules="nameRules" label="Nombre de Usuario" prepend-inner-icon="mdi-account" background-color="" require></v-text-field>

                                        <v-text-field v-model="password" :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'" :rules="[rules.required, rules.min]" :type="show1 ? 'text' : 'password'" name="input-10-1" label="Contraseña" hint="" counter background-color="" prepend-inner-icon="mdi-lock" @click:append="show1 = !show1"></v-text-field>

                                        <v-btn :disabled="!valid" color="success" small class="mr-4 mt-4" @click="validate">
                                            <v-icon small>mdi-home-account</v-icon>
                                            Iniciar
                                        </v-btn>

                                        <v-btn color="error" small class="mr-4 mt-4" @click="reset">
                                            <v-icon small>mdi-cancel</v-icon>
                                            Cancelar
                                        </v-btn>
                                    </v-form>
                                </v-col>
                            </template>


                        </v-card>
                    </v-container>
                </v-col>
            </v-row>
        </v-app>
    </div>


    <!-- Scripts -->
    <script src="../../node_modules/vue.js"></script>
    <script src="../../node_modules/vuetify.js"></script>
    <script src="../../node_modules/axios.min.js"></script>
    <script src="../../node_modules/99eb8c8193.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery.js" charset="utf-8"></script>
    <script src="../../node_modules/jquery.includeHTML.min.js" charset="utf-8"></script>
    <script src="../../node_modules/printThis.js"></script>
    <script src="main.js" charset="utf-8"></script>
</body>

</html>