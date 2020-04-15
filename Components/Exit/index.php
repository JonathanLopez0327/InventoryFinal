<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Salida</title>

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

      <!-- Content -->

      <v-content class="pepe">
        <v-container fluid>

          <!-- Tables -->
          <template>
            <v-card-title>
              <v-chip class="ma-2" color="#245699" label text-color="white">
                <v-icon left>mdi-file-move</v-icon>
                Reporte de Salida
              </v-chip>

              <v-spacer></v-spacer>

              <v-btn class="elevation-10 ma-2" fab dark small color="#245699">
                <v-icon dark>mdi-printer</v-icon>
              </v-btn>

              <v-btn class="ma-2 elevation-10" fab dark small color="#245699" @click="menuu = true">
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

              <!-- Menu expa -->

              <v-dialog v-model="menuu" fullscreen hide-overlay transition="dialog-bottom-transition" scrollable>
                <v-card tile color="" class="pepito">
                  <v-toolbar flat dark color="#6dbec6" height="50">
                    <v-btn icon dark @click="menuu = false">
                      <v-icon>mdi-close</v-icon>
                    </v-btn>
                    <v-toolbar-title>Inventario</v-toolbar-title>
                    <v-spacer></v-spacer>
                  </v-toolbar>

                  <v-card-text>

                    <!-- Datatable for inventory -->
                    <template>
                      <v-card height="650" cols="12" sm="6" md="4" class="mt-8 table mb-4">
                        <v-card-title>
                          <v-spacer></v-spacer>
                          <v-text-field v-model="searchTwo" append-icon="mdi-magnify" label="Search" flat solo-inverted hide-details x-small></v-text-field>
                        </v-card-title>

                        <div class="table">
                          <v-data-table dense height="400" class="data-table" :headers="headersTwo" :items="productos" :search="searchTwo" :items-per-page="10">

                            <template v-slot:item.pepe="{ item }">
                              <v-chip :color="getColor(item.CATEGORY)" dark x-small>{{ item.CATEGORY }}</v-chip>
                            </template>

                            <!-- Options Eition -->
                            <template v-slot:item.accion="{ item }">
                              <v-icon dark class="" fab color="#245699" @click="editar(item)">mdi-plus</v-icon>
                            </template>

                          </v-data-table>
                        </div>
            </v-card-title>
          </template>

          <!-- Card for menu -->
          <template>
            <v-card class="mt-8 mb-4" width="1500">
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

                <v-chip class="ma-2" color="#245699" label text-color="#245699" outlined>
                  <v-icon left>mdi-package-variant-closed</v-icon>
                  {{ editado.CATEGORY }}
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



          </v-card-text>

          <div style="flex: 1 1 auto;"></div>
          </v-card>
          </v-dialog>

          <!-- fin menu -->

          <v-spacer></v-spacer>
          <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" flat solo-inverted hide-details dark x-small></v-text-field>
          </v-card-title>


          </template>

          <!-- Contenido visible al cargar -->

          <template>
            <v-card height="650" cols="12" sm="6" md="4" class="mt-8">
              <v-card-title>
                <v-sheet class="v-sheet--offset" color="#245699" dark elevation="12" max-width="calc(100% - 40px)">
                  <div class="iconos">
                    <v-icon x-large class="icon-title">mdi-file-chart</v-icon>
                  </div>
                </v-sheet>

                <v-spacer></v-spacer>

              </v-card-title>

              <!-- Segundo Datatable -->

              <div class="table">
                <v-data-table dense height="400" class="data-table" :headers="headers" :items="reportes" :search="search" :items-per-page="10">
                  
                  <template v-slot:item.pepee="{ item }">
                    <v-chip :color="getColor1(item.CATEGORY_EXIT)" dark x-small>{{ item.CATEGORY_EXIT }}</v-chip>
                  </template>

                  <!-- Options Eition -->
                  <template v-slot:item.accion="{ item }">
                    <v-icon class="" color="#245699" @click="check(item)">mdi-eye</v-icon>

                    <v-icon class="" color="error" @click="borrarReporte(item)">mdi-delete</v-icon>
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

          <!-- Dialog vista -->

          <template>
            <div class="text-center">
              <v-dialog v-model="dialogCheck" width="700">
                <v-card>
                  <v-card-title class="headline" primary-title>
                    <v-chip class="ma-2 text-center" color="#6dbec6" width="500" label text-color="white">
                      <v-icon left class="mr-2">mdi-file</v-icon>
                      Vista del reporte de salida
                    </v-chip>
                  </v-card-title>

                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.CODE_PRODUCT_EXIT" label="Codigo del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.NAME_PRODUCT_EXIT" label="Nombre del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.STOCK_EXIT" label="Salida del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.UNITARY_PRICE_EXIT" label="Precio Unitario del Producto" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.UNIT_PRODUCT_EXIT" label="Unidad del Producto" type="" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.CATEGORY_EXIT" label="Categoria" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.DATE_OF_EXIT" label="Fecha de Salida" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
                        </v-col>

                        <v-col cols="12" sm="6" md="4">
                          <v-text-field v-model="editado.STOCK_CURRENT" label="Cantidad Actual" color="#064a76" clearable prepend-icon="mdi-package-variant"></v-text-field>
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




        </v-container>
      </v-content>


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