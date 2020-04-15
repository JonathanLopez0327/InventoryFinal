<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tareas</title>

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
            <v-navigation-drawer v-model="drawer" app color="#064a76" dark src="../../Images/wallpaper2.jpg">
                <v-list dense>

                    <v-list-item>
                        <v-sheet class="icons-nav" color="#fff" elevation="12" max-width="calc(100% - 32px)">
                            <v-icon>mdi-apps</v-icon>
                        </v-sheet>
                        <v-list-item-content class="mb-2">
                            <v-list-item-title class="title ml-2">
                                F-F Inventory
                            </v-list-item-title>
                            <v-list-item-subtitle class="ml-2">
                                Panel de Control
                            </v-list-item-subtitle>
                        </v-list-item-content>
                    </v-list-item>

                    <v-divider class="mt-1"></v-divider>

                    <template v-for="item in itemsNav">
                        <v-layout v-if="item.heading" :key="item.heading" row align-center>
                            <v-flex xs6>
                                <v-subheader v-if="item.heading">
                                    {{ item.heading }}
                                </v-subheader>
                            </v-flex>
                            <v-flex xs6 class="text-xs-center">
                                <a href="#!" class="body-2 black--text">EDIT</a>
                            </v-flex>
                        </v-layout>
                        <v-list-group v-else-if="item.children" :key="item.text" v-model="item.model" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" class="list-style">
                            <template v-slot:activator>
                                <v-list-item>
                                    <v-list-item-content>
                                        <v-list-item-title>
                                            {{ item.text }}
                                        </v-list-item-title>
                                    </v-list-item-content>
                                </v-list-item>
                            </template>

                            <v-list-item v-for="(child, i) in item.children" :key="i" class="list-style-sub" :href="child.href">
                                <v-list-item-action v-if="child.icon">
                                    <v-icon color="text-nav">{{ child.icon }}</v-icon>
                                </v-list-item-action>
                                <v-list-item-content>
                                    <v-list-item-title>
                                        {{ child.text }}
                                    </v-list-item-title>
                                </v-list-item-content>
                            </v-list-item>
                        </v-list-group>

                        <v-list-item v-else :key="item.text" @click="" class="list-style" :href="item.href" flat>
                            <v-list-item-action>
                                <v-icon>{{ item.icon }}</v-icon>
                            </v-list-item-action>

                            <v-list-item-content>
                                <v-list-item-title class="">
                                    {{ item.text }}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </template>
                </v-list>
            </v-navigation-drawer>

            <v-app-bar app color="#245699" dark class="elevation-0">
                <v-toolbar-title style="width: 300px" class="ml-0 pl-3">
                    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
                    <span class="hidden-sm-and-down">Fast-Flexible Inventory</span>
                </v-toolbar-title>
                <v-text-field flat solo-inverted hide-details prepend-inner-icon="mdi-magnify" label="Search" class="hidden-sm-and-down"></v-text-field>

                <v-spacer></v-spacer>

                <v-btn icon>
                    <v-icon>mdi-apps</v-icon>
                </v-btn>
                <v-btn icon>
                    <v-icon>mdi-bell</v-icon>
                </v-btn>
                <v-btn icon large>
                    <v-avatar size="32px" item>
                        <v-img src="https://cdn.vuetifyjs.com/images/logos/logo.svg" alt="Vuetify"></v-img>
                    </v-avatar>
                </v-btn>
            </v-app-bar>

            <!-- Contente -->

            <v-content class="pepe">
                <v-container fluid>

                    <template>
                        <v-card class="pepito" width="1500" height="80">
                            <v-list-item three-line>
                                <v-list-item-content>
                                    <div class="overline mb-2">
                                        <template>
                                            <div class="">
                                                <v-bottom-sheet v-model="sheet" max-width="400px" transition="scale-transition" scrollable>
                                                    <template v-slot:activator="{ on }">
                                                        <v-btn color="#6dbec6" dark v-on="on" class="text-capitalize" small>
                                                            <v-icon dark class="">mdi-plus</v-icon>
                                                            Agregar una nueva tarea
                                                        </v-btn>
                                                    </template>
                                                    <template>
                                                        <v-card class="mx-auto mt-2" width="344">
                                                            <v-chip class="ma-2 text-center" color="#6dbec6" label text-color="white">
                                                                <v-icon left class="mr-2">mdi-calendar</v-icon>
                                                                Nueva Tarea
                                                            </v-chip>

                                                            <v-card-text style="height: 400px;">
                                                                <v-container fluid class="">
                                                                    <v-row>
                                                                        <v-col cols="12" sm="5" md="12">
                                                                            <v-text-field v-model="editado.TASK" label="Tarea" clearable></v-text-field>
                                                                        </v-col>

                                                                        <v-col cols="12" sm="5" md="12">
                                                                            <v-textarea v-model="editado.TASK_DESCRIPTION" append-icon="" class="" label="Descripcion de la tarea" rows="1" clearable></v-textarea>
                                                                        </v-col>

                                                                        <v-col cols="12" sm="6" md="12">
                                                                            <v-combobox v-model="editado.CATEGORY_TASK" :items="items" label="Selecciona la categoria de la tarea" clearable></v-combobox>
                                                                        </v-col>

                                                                        <v-col cols="12" sm="6" md="12">
                                                                            <v-combobox v-model="editado.ORIENTED_TO" :items="itemsOrinted" label="Selecciona para que modulo es la tarea" clearable></v-combobox>
                                                                        </v-col>
                                                                    </v-row>
                                                                </v-container>
                                                            </v-card-text>

                                                            <v-card-actions>
                                                                <v-spacer></v-spacer>
                                                                <v-btn color="error" small class="ma-2 white--text elevation-5" @click="cancelar">
                                                                    <v-icon x-small dark>mdi-cancel</v-icon>
                                                                    Cancelar
                                                                </v-btn>
                                                                <v-btn color="#6dbec6" small class="ma-2 white--text elevation-5" @click="guardar">
                                                                    <v-icon x-small dark>mdi-content-save</v-icon>
                                                                    Guardar
                                                                </v-btn>
                                                            </v-card-actions>
                                                        </v-card>
                                                    </template>

                                                </v-bottom-sheet>
                                            </div>
                                        </template>
                                    </div>
                                </v-list-item-content>

                                <v-list-item-avatar tile size="55" color="#6dbec6" class="card elevation-5">
                                    <v-icon dark class="" size="40">mdi-calendar-check</v-icon>
                                </v-list-item-avatar>
                            </v-list-item>

                            <v-card-actions>

                            </v-card-actions>
                        </v-card>
                    </template>

                    <!-- Datatable -->
                    <template>
                        <v-card height="500" cols="12" sm="6" md="4" class="mt-8">
                            <v-card-title>
                                <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" flat solo-inverted hide-details x-small></v-text-field>
                            </v-card-title>

                            <div class="table">
                                <v-data-table dense height="300" class="data-table" :headers="headers" :items="task" :search="search" :items-per-page="10">

                                    <template v-slot:item.pepe="{ item }">
                                        <v-chip :color="getColor(item.CATEGORY_TASK)" dark x-small>{{ item.CATEGORY_TASK }}</v-chip>
                                    </template>

                                    <!-- Options Eition -->
                                    <template v-slot:item.accion="{ item }">
                                        <v-icon dark color="#064a76" @click="check(item)">mdi-eye</v-icon>

                                        <v-icon dark color="#064a76" @click="editar(item)">mdi-calendar-edit</v-icon>

                                        <v-icon dark color="error" @click="borrar(item)">mdi-calendar-minus</v-icon>
                                    </template>

                                </v-data-table>
                            </div>

                            <!-- template para el snackbar-->
                            <template>
                                <div class="text-center ma-2">
                                    <v-snackbar v-model="snackbar">
                                        {{ textSnack }}
                                        <v-btn color="info" text @click="snackbar = false">Cerrar</v-btn>
                                    </v-snackbar>
                                </div>
                            </template>

                    </template>
                    </v-card>


                </v-container>
            </v-content>


            <!-- Dialog vista -->

            <template>
                <div class="text-center">
                    <v-dialog v-model="dialog" width="500">
                        <v-card>
                            <v-card-title class="headline" primary-title>
                                <v-chip class="ma-2 text-center" color="#6dbec6" width="500" label text-color="white">
                                    <v-icon left class="mr-2">mdi-eye-check</v-icon>
                                    Vista de tarea
                                </v-chip>
                            </v-card-title>

                            <v-card-text>
                                <v-container fluid class="">
                                    <v-row>
                                        <v-col cols="12" sm="5" md="12">
                                            <v-text-field v-model="editado.TASK" label="Tarea" clearable></v-text-field>
                                        </v-col>

                                        <v-col cols="12" sm="5" md="12">
                                            <v-textarea v-model="editado.TASK_DESCRIPTION" append-icon="" class="" label="Descripcion de la tarea" rows="3" clearable></v-textarea>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="12">
                                            <v-combobox v-model="editado.CATEGORY_TASK" :items="items" label="Selecciona la categoria de la tarea" clearable></v-combobox>
                                        </v-col>

                                        <v-col cols="12" sm="6" md="12">
                                            <v-combobox v-model="editado.ORIENTED_TO" :items="itemsOrinted" label="Selecciona para que modulo es la tarea" clearable></v-combobox>
                                        </v-col>

                                        <v-col cols="12" sm="5" md="12">
                                            <v-text-field v-model="editado.DATE_TASK" label="Tarea" clearable></v-text-field>
                                        </v-col>
                                    </v-row>
                                </v-container>
                            </v-card-text>

                            <v-divider></v-divider>

                            <v-card-actions>
                                <v-spacer></v-spacer>
                                <v-btn color="#6dbec6" small class="ma-2 white--text elevation-5 text-capitalize" @click="dialog = false">
                                    <v-icon x-small dark>mdi-reload</v-icon>
                                    Volver
                                </v-btn>
                            </v-card-actions>
                        </v-card>
                    </v-dialog>
                </div>
            </template>


        </v-app>
    </div>


    <!-- Scripts -->
    <script src="../../node_modules/vue.js"></script>
    <script src="../../node_modules/vuetify.js"></script>
    <script src="../../node_modules/axios.min.js"></script>
    <script src="../../node_modules/99eb8c8193.js" crossorigin="anonymous"></script>
    <script src="../../node_modules/jquery.js" charset="utf-8"></script>
    <script src="../../node_modules/jquery.includeHTML.min.js" charset="utf-8"></script>
    <script src="main.js" charset="utf-8"></script>

</body>

</html>