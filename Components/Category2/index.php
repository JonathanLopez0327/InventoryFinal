<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mobiliarios</title>

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

              <v-list-item v-for="(child, i) in item.children" :key="i" :href="child.href" class="list-style-sub">
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

            <v-list-item v-else :key="item.text" @click="" class="list-style" :href="item.href">
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

      <!-- Content -->

      <v-content class="pepe">
        <v-container fluid>

          <!-- Tables -->
          <template>
            <v-card-title>
              <v-chip class="ma-2" color="#245699" label text-color="white">
                <v-icon left>mdi-package-variant</v-icon>
                Productos de Limpieza
              </v-chip>

              <v-spacer></v-spacer>

              <v-btn class="elevation-10 ma-2" fab dark small color="#245699">
                <v-icon dark>mdi-printer</v-icon>
              </v-btn>

              <v-btn class="ma-2 elevation-10" fab dark small color="#245699" @click="dialog = !dialog">
                <v-icon dark>mdi-plus</v-icon>
              </v-btn>

              <v-btn class="ma-2 elevation-10" fab dark small color="#245699">
                <v-icon dark>mdi-file-pdf-outline</v-icon>
              </v-btn>

              <v-btn class="ma-2 elevation-10" fab dark small color="#245699">
                <v-icon dark>mdi-file-word-outline</v-icon>
              </v-btn>

              <v-btn class="ma-2 elevation-10" fab dark small color="#245699">
                <v-icon dark>mdi-file-excel-outline</v-icon>
              </v-btn>


              <v-spacer></v-spacer>
              <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" flat solo-inverted hide-details dark x-small></v-text-field>
            </v-card-title>


          </template>

          <template>
            <v-card height="650" cols="12" sm="6" md="4" class="mt-8">
              <v-card-title>
                <v-sheet class="v-sheet--offset" color="#245699" dark elevation="12" max-width="calc(100% - 40px)">
                  <div class="iconos">
                    <v-icon x-large class="icon-title">mdi-package-variant</v-icon>
                  </div>
                </v-sheet>

                <v-spacer></v-spacer>

              </v-card-title>

              <div class="table">
                <v-data-table dense height="400" class="data-table" :headers="headers" :items="productos" :search="search" :items-per-page="10">
                  <!-- Modal for add -->

                  <template v-slot:top>
                    <!--  Modal del diálogo para Alta y Edicion    -->
                    <v-dialog v-model="dialog" max-width="800px">
                      <template v-slot:activator="{ on }"></template>
                      <v-card>
                        <v-card-title dark class="">
                          <v-icon>mdi-package-variant-closed</v-icon>
                          <v-toolbar-title class="ml-5">{{ formTitle }}</v-toolbar-title>
                        </v-card-title>

                        <v-card-text>
                          <v-container>
                            <v-row>
                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.CODE_PRODUCT" label="Codigo del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                              </v-col>

                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.NAME_PRODUCT" label="Nombre del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                              </v-col>

                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.UNIT_PRODUCT" label="Unidad del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                              </v-col>

                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.STOCK" label="Cantidad a Agregar" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                              </v-col>

                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.DATE_INITIAL" label="Fecha Inicial" type="date" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                              </v-col>

                              <v-col cols="12" sm="6" md="4">
                                <v-combobox v-model="editado.CATEGORY" :items="Categories" label="Selecciona la categoria" clearable></v-combobox>
                              </v-col>

                              <v-col cols="12" sm="6" md="4">
                                <v-text-field v-model="editado.UNITARY_PRICE" label="Precio Unitario" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                              </v-col>
                            </v-row>
                          </v-container>
                        </v-card-text>

                        <v-card-actions>
                          <v-spacer></v-spacer>
                          <v-btn color="error" small class="ma-2 white--text elevation-10" @click="cancelar">
                            <v-icon x-small dark>mdi-cancel</v-icon>
                            Cancelar
                          </v-btn>
                          <v-btn color="#064a76" small class="ma-2 white--text elevation-10" @click="guardar">
                            <v-icon x-small dark>mdi-content-save</v-icon>
                            Guardar
                          </v-btn>
                        </v-card-actions>

                      </v-card>
                    </v-dialog>
                  </template>

                  <template v-slot:item.pepe="{ item }">
                    <v-chip :color="getColor(item.CATEGORY)" dark x-small>{{ item.CATEGORY }}</v-chip>
                  </template>

                  <!-- Options Eition -->
                  <template v-slot:item.accion="{ item }">
                    <v-icon dark class="" color="#245699" @click="check(item)">mdi-eye</v-icon>

                    <v-icon dark class="" color="#245699" @click="editar(item)">mdi-pencil</v-icon>

                    <v-icon dark class="" color="error" @click="borrar(item)">mdi-delete</v-icon>

                    <v-icon dark color="#6dbec6" @click="obtener(item)">mdi-package-variant-closed</v-icon>

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

          <!-- Form Report EXIT -->

          <template>
            <v-card class="mt-8" width="1500">
              <v-list-item three-line>
                <v-list-item-content>
                  <v-list-item-title class="headline mb-1">
                    <v-chip class="ma-2" color="#245699" label text-color="white">
                      <v-icon left>mdi-package-variant-closed</v-icon>
                      Reporte de Salida
                    </v-chip>
                  </v-list-item-title>
                  <v-spacer></v-spacer>
                  <v-list-item-subtitle></v-list-item-subtitle>
                </v-list-item-content>

                <v-list-item-avatar tile size="50" color="#245699" class="elevation-10 total">
                  {{ editado.STOCK }}
                </v-list-item-avatar>
              </v-list-item>

              <v-card-text>
                <v-chip class="ma-2" color="#245699" label text-color="#245699" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.CODE_PRODUCT }}
                </v-chip>

                <v-chip class="ma-2" color="#245699" label text-color="#245699" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.NAME_PRODUCT }}
                </v-chip>

                <v-chip class="ma-2" color="#245699" label text-color="#245699" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.UNIT_PRODUCT }}
                </v-chip>

                <v-chip class="ma-2" color="#6dbec6" label text-color="#6dbec6" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.STOCK_EXIT }}
                </v-chip>

                <v-chip class="ma-2" color="#245699" label text-color="#245699" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.DATE_INITIAL }}
                </v-chip>

                <v-chip class="ma-2" color="#245699" label text-color="#245699" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.CATEGORY }}
                </v-chip>

                <v-chip class="ma-2" color="#245699" label text-color="#245699" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.UNITARY_PRICE }}
                </v-chip>

                <!-- Form -->
                <v-col cols="12" sm="4" md="2">
                  <v-text-field v-model="editado.STOCK_EXIT" label="Salida" color="#6dbec6" clearable append-icon="mdi-package-variant-closed"></v-text-field>
                </v-col>

              </v-card-text>

              <v-card-actions>
                <v-btn color="error" small class="ma-2 white--text elevation-5" @click="cancelar">
                  <v-icon x-small dark class="ma-1">mdi-cancel</v-icon>
                  Limpiar
                </v-btn>
                <v-btn color="#245699" small class="ma-2 white--text elevation-5" @click="actualizarStock">
                  <v-icon x-small dark class="ma-1">mdi-content-save</v-icon>
                  Realizar Reporte
                </v-btn>
              </v-card-actions>
            </v-card>
          </template>


        </v-container>
      </v-content>

      <!-- Dialog vista -->

      <template>
        <div class="text-center">
          <v-dialog v-model="dialogCheck" width="700">
            <v-card>
              <v-card-title class="headline" primary-title>
                <v-chip class="ma-2 text-center" color="#6dbec6" width="500" label text-color="white">
                  <v-icon left class="mr-2">mdi-package-variant</v-icon>
                  Vista de producto
                </v-chip>
              </v-card-title>

              <v-card-text>
                <v-container>
                  <v-row>
                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editado.CODE_PRODUCT" label="Codigo del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editado.NAME_PRODUCT" label="Nombre del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editado.UNIT_PRODUCT" label="Unidad del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editado.STOCK" label="Cantidad a Agregar" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editado.DATE_INITIAL" label="Fecha Inicial" type="date" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editado.CATEGORY" label="Categoria" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                    </v-col>

                    <v-col cols="12" sm="6" md="4">
                      <v-text-field v-model="editado.UNITARY_PRICE" label="Precio Unitario" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                    </v-col>
                  </v-row>
                </v-container>
              </v-card-text>

              <v-divider></v-divider>

              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="#6dbec6" small class="ma-2 white--text elevation-5 text-capitalize" @click="cancelar">
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