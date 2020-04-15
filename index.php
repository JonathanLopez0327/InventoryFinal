<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pagina Principal</title>

  <!-- Styles -->
  <link href="node_modules/css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="node_modules/vuetify.min.css" rel="stylesheet">
  <link rel="stylesheet" href="app.css">
</head>

<body>

  <!-- App -->
  <div id="app">
    <v-app id="inspire">
      <v-navigation-drawer v-model="drawer" app color="#064a76" dark src="Images/wallpaper2.jpg">
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
            <v-list-group v-else-if="item.children" :key="item.text"  v-model="item.model" :prepend-icon="item.model ? item.icon : item['icon-alt']" append-icon="" class="list-style">
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

      <v-content>
        <v-container fluid fill-height>

          <!-- Cards stadisticas -->




        </v-container>
      </v-content>


    </v-app>
  </div>


  <!-- Scripts -->
  <script src="node_modules/vue.js"></script>
  <script src="node_modules/vuetify.js"></script>
  <script src="node_modules/axios.min.js"></script>
  <script src="node_modules/99eb8c8193.js" crossorigin="anonymous"></script>
  <script src="node_modules/jquery.js" charset="utf-8"></script>
  <script src="node_modules/jquery.includeHTML.min.js" charset="utf-8"></script>
  <script src="app.js" charset="utf-8"></script>

</body>

</html>