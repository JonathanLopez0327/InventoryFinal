$(document).ready(function () {
  console.log("El sistema ha iniciado...");

  // Locaciones del Backend
  var Salida_R = "../../Backend/Exit/index.php";
  var Entrada = "../../Backend/Entry/index.php";
  var Inventory = "../../Backend/Inventory/index.php";

  // Fecha actual
  var f = new Date();
  var fecha = f.getFullYear() + "-" + f.getMonth() + "-" + f.getDate();

  // vue
  new Vue({
    el: "#app",
    vuetify: new Vuetify(),
    data: () => ({
      search: "",
      searchTwo: "",
      dialog: false,
      dialogReport: false,
      dialogCheck: false,
      drawer: null,
      menuu: false,
      snackbar: false,
      textSnack: "texto snackbar",

      itemsNav: [
        { icon: "mdi-home", text: "Inicio", href: "../../" },

        {
          icon: "mdi-account-cog",
          "icon-alt": "mdi-account-cog",
          text: "Opciones",
          model: false,
          children: [
            { icon: "mdi-account", text: "Usuarios", href: "../SignUp/" },
            { icon: "mdi-account", text: "Sesiones Activas" },
          ],
        },
        {
          icon: "mdi-package-variant-closed",
          "icon-alt": "mdi-package-variant-closed",
          text: "Inventario",
          model: false,
          children: [
            { icon: "mdi-package-variant", text: "Categoria 1", href: '../Category1/' },
            { icon: "mdi-package-variant", text: "Categoria 2", href: '../Category2/' },
            { icon: "mdi-package-variant", text: "Categoria 3", href: '../Category3/' },
            {
              icon: "mdi-package-variant",
              text: "Inventario General",
              href: "../Inventory/",
            },
          ],
        },
        {
          icon: "mdi-file-chart",
          "icon-alt": "mdi-file-chart",
          text: "Reportes",
          model: true,
          children: [
            {
              icon: "mdi-file-download",
              text: "Reportes de Salidas",
              href: "../Exit/",
            },
            { icon: "mdi-file-move", text: "Reportes de Entradas" },
          ],
        },
        {
          icon: "mdi-file-clock",
          "icon-alt": "mdi-file-clock",
          text: "Tareas",
          model: false,
          children: [
            { icon: "mdi-file-check", text: "Tareas", href: "../Task/" },
          ],
        },
      ],

      // DataTable
      headers: [
        {
          text: "ID",
          align: "left",
          sortable: false,
          value: "ID_ENTRY",
        },
        { text: "Codigo", value: "CODE_PRODUCT_ENTRY" },
        { text: "Producto", value: "NAME_PRODUCT_ENTRY" },
        { text: "Cantidad Inicial", value: "STOCK_ENTRY" },
        { text: "Precio Unitario", value: "UNITARY_PRICE_ENTRY" },
        { text: "Unidad", value: "UNIT_PRODUCT_ENTRY" },
        { text: "Categoria", value: "pepee", sortable: false },
        { text: "Fecha de Entrada", value: "DATE_OF_ENTRY" },
        // { text: 'Cantidad Inicial', value: 'STOCK_CURRENT'},
        { text: "Opciones", value: "accion", sortable: false, align: "center" },
      ],

      headersTwo: [
        {
          text: "ID",
          align: "left",
          value: "ID_INVENTORY",
        },
        { text: "Codigo", value: "CODE_PRODUCT" },
        { text: "Descripcion", value: "NAME_PRODUCT" },
        { text: "Presentacion", value: "UNIT_PRODUCT" },
        { text: "Disponible", value: "STOCK" },
        { text: "Fecha", value: "DATE_INITIAL" },
        { text: "Categoria", value: "pepe", sortable: false },
        { text: "Precio Unitario", value: "UNITARY_PRICE" },
        { text: "Opciones", value: "accion", sortable: false },
        // { text: 'Informacion', value: 'obten', sortable: false },
      ],

      productos: [],
      reportes: [],

      Categories: ["Limpieza", "Gastables", "Mobiliarios"],

      editedIndex: -1,

      editado: {
        // Inventario
        ID_INVENTORY: "",
        CODE_PRODUCT: "",
        NAME_PRODUCT: "",
        UNIT_PRODUCT: "",
        STOCK: "",
        DATE_INITIAL: "",
        CATEGORY: "",
        UNITARY_PRICE: "",

        // Entrada
        ID_ENTRY: "",
        CODE_PRODUCT_ENTRY: "",
        NAME_PRODUCT_ENTRY: "",
        STOCK_ENTRY: "",
        UNITARY_PRICE_ENTRY: "",
        UNIT_PRODUCT_ENTRY: "",
        DATE_OF_ENTRY: "",
        CATEGORY_ENTRY: "",
      },
      defaultItem: {
        // Inventario
        ID_INVENTORY: "",
        CODE_PRODUCT: "",
        NAME_PRODUCT: "",
        UNIT_PRODUCT: "",
        STOCK: "",
        DATE_INITIAL: "",
        CATEGORY: "",
        UNITARY_PRICE: "",

        // Entrada
        ID_ENTRY: "",
        CODE_PRODUCT_ENTRY: "",
        NAME_PRODUCT_ENTRY: "",
        STOCK_ENTRY: "",
        UNITARY_PRICE_ENTRY: "",
        UNIT_PRODUCT_ENTRY: "",
        DATE_OF_ENTRY: "",
        CATEGORY_ENTRY: "",
      },
    }),

    // Funciones

    computed: {
      //Dependiendo si es Alta o Edición cambia el título del modal
      formTitle() {
        //operadores condicionales "condición ? expr1 : expr2"
        // si <condicion> es true, devuelve <expr1>, de lo contrario devuelve <expr2>
        return this.editedIndex === -1
          ? "Entrada de Productos"
          : "Modificar Informacion";
      },
    },

    watch: {
      dialog(val) {
        val || this.cancelar();
      },
    },

    created() {
      this.listarProductos();
      this.listarReportes();
      this.rtdb();
    },

    // Metodos

    methods: {
      getColor(CATEGORY) {
        if (CATEGORY == "Limpieza") return "#6dbec6";
        else if (CATEGORY == "Mobiliarios") return "orange";
        else if (CATEGORY == "Gastables") return "#245699";
        else return "black";
      },
      // Categoria
      getColor1(CATEGORY_ENTRY) {
        if (CATEGORY_ENTRY == "Limpieza") return "#6dbec6";
        else if (CATEGORY_ENTRY == "Mobiliarios") return "orange";
        else if (CATEGORY_ENTRY == "Gastables") return "#245699";
        else return "black";
      },
      // Procedimiento para listar los productos
      listarProductos: function () {
        axios.post(Inventory, { opcion: 4 }).then((response) => {
          this.productos = response.data;
        });
      },

      // Listar Entrada de Productos
      listarReportes: function () {
        axios.post(Entrada, { opcion: 4 }).then((response) => {
          this.reportes = response.data;
        });
      },

      // Procedimiento para agregar en el invetario

      altaInvetario: function () {
        axios
          .post(Inventory, {
            opcion: 1,
            CODE_PRODUCT: this.CODE_PRODUCT,
            NAME_PRODUCT: this.NAME_PRODUCT,
            UNIT_PRODUCT: this.UNIT_PRODUCT,
            STOCK: this.STOCK,
            DATE_INITIAL: this.DATE_INITIAL,
            CATEGORY: this.CATEGORY,
            UNITARY_PRICE: this.UNITARY_PRICE,
          })
          .then((response) => {
            this.listarProductos();
          });

        (this.CODE_PRODUCT = ""),
          (this.NAME_PRODUCT = ""),
          (this.UNIT_PRODUCT = ""),
          (this.STOCK = ""),
          (this.DATE_INITIAL = ""),
          (this.CATEGORY = ""),
          (this.UNITARY_PRICE = "");
      },

      editarInventarios: function (
        ID_INVENTORY,
        CODE_PRODUCT,
        NAME_PRODUCT,
        UNIT_PRODUCT,
        STOCK,
        DATE_INITIAL,
        CATEGORY,
        UNITARY_PRICE
      ) {
        axios
          .post(Inventory, {
            opcion: 2,
            ID_INVENTORY: ID_INVENTORY,
            CODE_PRODUCT: CODE_PRODUCT,
            NAME_PRODUCT: NAME_PRODUCT,
            UNIT_PRODUCT: UNIT_PRODUCT,
            STOCK: STOCK,
            DATE_INITIAL: DATE_INITIAL,
            CATEGORY: CATEGORY,
            UNITARY_PRICE: UNITARY_PRICE,
          })
          .then((response) => {
            this.listarProductos();
          });
      },

      // Procedimiento para registrar la entrada del producto

      altaEntrada: function () {
        axios
          .post(Entrada, {
            opcion: 1,
            CODE_PRODUCT_ENTRY: this.CODE_PRODUCT_ENTRY,
            NAME_PRODUCT_ENTRY: this.NAME_PRODUCT_ENTRY,
            STOCK_ENTRY: this.STOCK_ENTRY,
            UNITARY_PRICE_ENTRY: this.UNITARY_PRICE_ENTRY,
            UNIT_PRODUCT_ENTRY: this.UNIT_PRODUCT_ENTRY,
            DATE_OF_ENTRY: fecha,
            CATEGORY_ENTRY: this.CATEGORY_ENTRY,
          })
          .then((response) => {
            this.listarProductos();
          });

        (this.CODE_PRODUCT_ENTRY = ""),
          (this.NAME_PRODUCT_ENTRY = ""),
          (this.STOCK_ENTRY = ""),
          (this.UNITARY_PRICE_ENTRY = ""),
          (this.UNIT_PRODUCT_ENTRY = ""),
          (this.CATEGORY_ENTRY = "");
      },

      // En caso de edicion del reporte de entrada
      editarReportes: function (
        ID_ENTRY,
        CODE_PRODUCT_ENTRY,
        NAME_PRODUCT_ENTRY,
        STOCK_ENTRY,
        UNITARY_PRICE_ENTRY,
        UNIT_PRODUCT_ENTRY,
        DATE_OF_ENTRY,
        CATEGORY_ENTRY
      ) {
        axios
          .post(Entrada, {
            opcion: 2,
            ID_ENTRY: ID_ENTRY,
            CODE_PRODUCT_ENTRY: CODE_PRODUCT_ENTRY,
            NAME_PRODUCT_ENTRY: NAME_PRODUCT_ENTRY,
            STOCK_ENTRY: STOCK_ENTRY,
            UNITARY_PRICE_ENTRY: UNITARY_PRICE_ENTRY,
            UNIT_PRODUCT_ENTRY: UNIT_PRODUCT_ENTRY,
            DATE_OF_ENTRY: DATE_OF_ENTRY,
            CATEGORY_ENTRY: CATEGORY_ENTRY,
          })
          .then((response) => {
            this.listarReportes();
          });
      },

      // En caso de eliminar
      borrarReportes: function (ID_ENTRY) {
        axios
          .post(Entrada, { opcion: 3, ID_ENTRY: ID_ENTRY })
          .then((response) => {
            this.listarReportes();
          });
      },

      borrarProducto: function (ID_INVENTORY) {
        axios
          .post(Inventory, { opcion: 3, ID_INVENTORY: ID_INVENTORY })
          .then((response) => {
            this.listarProductos();
          });
      },

      // Seleccionar la fila
      editarReporte(item) {
        this.editedIndex = this.reportes.indexOf(item);
        this.editado = Object.assign({}, item);
        this.dialogReport = true;
      },

      check(item) {
        this.dialogCheck = true;
        this.editedIndex = this.productos.indexOf(item);
        this.editado = Object.assign({}, item);
      },

      editarInventario(item) {
        this.editedIndex = this.productos.indexOf(item);
        this.editado = Object.assign({}, item);
      },

      // Eliminar
      borrarReporte(item) {
        const index = this.reportes.indexOf(item);

        console.log(this.reportes[index].ID_ENTRY); //capturo el id de la fila seleccionada
        var r = confirm("¿Está seguro de eliminar el registro?");
        if (r == true) {
          this.borrarReportes(this.reportes[index].ID_ENTRY);
          this.snackbar = true;
          this.textSnack = "Se eliminó el registro.";
        } else {
          this.snackbar = true;
          this.textSnack = "Operación cancelada.";
        }
      },

      borrarInventario(item) {
        const index = this.productos.indexOf(item);

        console.log(this.productos[index].ID_INVENTORY); //capturo el id de la fila seleccionada
        var r = confirm("¿Está seguro de eliminar el registro?");
        if (r == true) {
          this.borrarProducto(this.productos[index].ID_INVENTORY);
          this.snackbar = true;
          this.textSnack = "Se eliminó el registro.";
        } else {
          this.snackbar = true;
          this.textSnack = "Operación cancelada.";
        }
      },

      // Tiempo Real

      rtdb() {
        setInterval(this.listarReportes, 1000);
        setInterval(this.listarProductos, 1000);
      },

      // Cerrar el Modal
      cancelar() {
        this.dialog = false;
        this.dialogCheck = false;
        this.dialogReport = false;
        this.salida_reporte = false;
        this.editado = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      },

      // Guardar Registros

      guardar() {
        if (this.editedIndex > -1) {
          this.ID_INVENTORY = this.editado.ID_INVENTORY;
          this.CODE_PRODUCT = this.editado.CODE_PRODUCT;
          this.NAME_PRODUCT = this.editado.NAME_PRODUCT;
          this.UNIT_PRODUCT = this.editado.UNIT_PRODUCT;
          this.STOCK = this.editado.STOCK;
          this.DATE_INITIAL = this.editado.DATE_INITIAL;
          this.CATEGORY = this.editado.CATEGORY;
          this.UNITARY_PRICE = this.editado.UNITARY_PRICE;

          this.snackbar = true;
          this.textSnack = "¡Actualización Exitosa!";
          this.editarInventarios(
            this.ID_INVENTORY,
            this.CODE_PRODUCT,
            this.NAME_PRODUCT,
            this.UNIT_PRODUCT,
            this.STOCK,
            this.DATE_INITIAL,
            this.CATEGORY,
            this.UNITARY_PRICE
          );
        } else {
          // Guardar los registros en caso de ingreso

          if (
            this.editado.CODE_PRODUCT == "" ||
            this.editado.NAME_PRODUCT == "" ||
            this.editado.UNIT_PRODUCT == "" ||
            this.editado.STOCK == "" ||
            this.editado.DATE_INITIAL == "" ||
            this.editado.CATEGORY == "" ||
            this.editado.UNITARY_PRICE == ""
          ) {
            this.snackbar = true;
            this.textSnack = "Datos incompletos.";
          } else {
            this.CODE_PRODUCT = this.editado.CODE_PRODUCT;
            this.NAME_PRODUCT = this.editado.NAME_PRODUCT;
            this.UNIT_PRODUCT = this.editado.UNIT_PRODUCT;
            this.STOCK = this.editado.STOCK;
            this.DATE_INITIAL = this.editado.DATE_INITIAL;
            this.CATEGORY = this.editado.CATEGORY;
            this.UNITARY_PRICE = this.editado.UNITARY_PRICE;

            this.CODE_PRODUCT_ENTRY = this.editado.CODE_PRODUCT;
            this.NAME_PRODUCT_ENTRY = this.editado.NAME_PRODUCT;
            this.STOCK_ENTRY = this.STOCK;
            this.UNITARY_PRICE_ENTRY = this.UNITARY_PRICE;
            this.UNIT_PRODUCT_ENTRY = this.UNITARY_PRICE;
            this.CATEGORY_ENTRY = this.CATEGORY;

            this.altaInvetario();
            this.altaEntrada();
            this.snackbar = true;
            this.textSnack = "¡Alta exitosa!";
          }
        }
        this.cancelar();
      },

      // Edicio del reporte

      guardarReporte() {
        if (this.editedIndex > -1) {
          this.ID_ENTRY = this.editado.ID_ENTRY;
          this.CODE_PRODUCT_ENTRY = this.editado.CODE_PRODUCT_ENTRY;
          this.NAME_PRODUCT_ENTRY = this.editado.NAME_PRODUCT_ENTRY;
          this.STOCK_ENTRY = this.editado.STOCK_ENTRY;
          this.UNITARY_PRICE_ENTRY = this.editado.UNITARY_PRICE_ENTRY;
          this.UNIT_PRODUCT_ENTRY = this.editado.UNIT_PRODUCT_ENTRY;
          this.DATE_OF_ENTRY = this.editado.DATE_OF_ENTRY;
          this.CATEGORY_ENTRY = this.editado.CATEGORY_ENTRY;

          this.snackbar = true;
          this.textSnack = "¡Actualización Exitosa!";
          this.editarReportes(
            this.ID_ENTRY,
            this.CODE_PRODUCT_ENTRY,
            this.NAME_PRODUCT_ENTRY,
            this.STOCK_ENTRY,
            this.UNITARY_PRICE_ENTRY,
            this.UNIT_PRODUCT_ENTRY,
            this.DATE_OF_ENTRY,
            this.CATEGORY_ENTRY
          );
        }

        this.cancelar();
      },
    },
  });
});
