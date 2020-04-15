$(document).ready(function () {
    console.log("El sistema ha iniciado...");
  
    // Locaciones del Backend
    var Salida_R = "../../Backend/Exit/index.php";
    var Entrada = "../../Backend/Entry/index.php";
    var Inventory = "../../Backend/Category1/index.php";
  
    // Fecha actual
    var f = new Date();
    var fecha = f.getFullYear() + "-" + f.getMonth() + "-" + f.getDate();
  
    // vue
    new Vue({
      el: "#app",
      vuetify: new Vuetify(),
      data: () => ({
        search: "",
        dialog: false,
        drawer: null,
        dialogCheck: false,
  
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
            model: true,
            children: [
              { icon: "mdi-package-variant", text: "Categoria 1" },
              { icon: "mdi-package-variant", text: "Categoria 2", href: '../Category2/' },
              { icon: "mdi-package-variant", text: "Categoria 3", href: '../Category3/' },
              { icon: "mdi-package-variant", text: "Inventario General", href: '../Inventory/' },
            ],
          },
          {
            icon: "mdi-file-chart",
            "icon-alt": "mdi-file-chart",
            text: "Reportes",
            model: false,
            children: [
              {
                icon: "mdi-file-download",
                text: "Reportes de Salidas",
                href: "../Exit/",
              },
              {
                icon: "mdi-file-move",
                text: "Reportes de Entradas",
                href: "../Entry/",
              },
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
  
        Categories: ["Limpieza", "Gastables", "Mobiliarios"],
  
        // DataTable
        headers: [
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
          CODE_PRODUCT_ENTRY: "",
          NAME_PRODUCT_ENTRY: "",
          STOCK_ENTRY: "",
          UNITARY_PRICE_ENTRY: "",
          UNIT_PRODUCT_ENTRY: "",
          DATE_OF_ENTRY: "",
          CATEGORY_ENTRY: "",
  
          // Salida
          CODE_PRODUCT_EXIT: "",
          NAME_PRODUCT_EXIT: "",
          STOCK_EXIT: "",
          UNITARY_PRICE_EXIT: "",
          UNIT_PRODUCT_EXIT: "",
          DATE_OF_EXIT: "",
          STOCK_CURRENT: "",
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
          CODE_PRODUCT_ENTRY: "",
          NAME_PRODUCT_ENTRY: "",
          STOCK_ENTRY: "",
          UNITARY_PRICE_ENTRY: "",
          UNIT_PRODUCT_ENTRY: "",
          DATE_OF_ENTRY: "",
          CATEGORY_ENTRY: "",
  
          // Salida
          CODE_PRODUCT_EXIT: "",
          NAME_PRODUCT_EXIT: "",
          STOCK_EXIT: "",
          UNITARY_PRICE_EXIT: "",
          UNIT_PRODUCT_EXIT: "",
          CATEGORY_EXIT: "",
          DATE_OF_EXIT: "",
          STOCK_CURRENT: "",
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
        this.rtdb();
      },
  
      // Metodos
  
      methods: {
        // Categoria 
        getColor(CATEGORY) {
          if (CATEGORY == "Limpieza") return "#6dbec6";
          else if (CATEGORY == "Mobiliarios") return "orange";
          else if (CATEGORY == "Gastables") return "#245699";
          else return "black";
        },
  
        // Procedimiento para listar los productos
        listarProductos: function () {
          axios.post(Inventory, { opcion: 4 }).then((response) => {
            this.productos = response.data;
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
  
        // Procedimiento para agregar el reporte de salida
  
        // Guardar el Reporte de salida
        guardarReporteSalida: function () {
          axios
            .post(Salida_R, {
              opcion: 1,
              CODE_PRODUCT_EXIT: this.CODE_PRODUCT_EXIT,
              NAME_PRODUCT_EXIT: this.NAME_PRODUCT_EXIT,
              STOCK_EXIT: this.STOCK_EXIT,
              UNITARY_PRICE_EXIT: this.UNITARY_PRICE_EXIT,
              UNIT_PRODUCT_EXIT: this.UNIT_PRODUCT_EXIT,
              CATEGORY_EXIT: this.CATEGORY_EXIT,
              DATE_OF_EXIT: fecha,
              STOCK_CURRENT: this.STOCK_CURRENT,
              STOCK: this.STOCK,
            })
            .then((response) => {
              this.listarProductos();
            });
  
          this.CODE_PRODUCT_EXIT = "";
          this.NAME_PRODUCT_EXIT = "";
          this.STOCK_EXIT = "";
          this.UNITARY_PRICE_EXIT = "";
          this.UNIT_PRODUCT_EXIT = "";
          this.STOCK_CURRENT = "";
          this.CATEGORY_EXIT = "";
        },
  
        // Procedimiento para editar
  
        editarInventario: function (
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
  
        editarStock: function (ID_INVENTORY, STOCK, STOCK_EXIT) {
          axios
            .post(Salida_R, {
              opcion: 5,
              ID_INVENTORY: ID_INVENTORY,
              STOCK: STOCK,
              STOCK_EXIT: STOCK_EXIT,
            })
            .then((response) => {
              this.listarProductos();
            });
        },
  
        // Eleminar producto del inventario
        borrarProducto: function (ID_INVENTORY) {
          axios
            .post(Inventory, { opcion: 3, ID_INVENTORY: ID_INVENTORY })
            .then((response) => {
              this.listarProductos();
            });
        },
  
        // Seleccionar la fila
        editar(item) {
          this.editedIndex = this.productos.indexOf(item);
          this.editado = Object.assign({}, item);
          this.dialog = true;
        },
  
        check(item) {
          this.dialogCheck = true;
          this.editedIndex = this.productos.indexOf(item);
          this.editado = Object.assign({}, item);
        },
  
        obtener(item) {
          this.editedIndex = this.productos.indexOf(item);
          this.editado = Object.assign({}, item);
          this.salida_reporte = true;
        },
  
        // Eliminar
        borrar(item) {
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
          setInterval(this.listarProductos, 1000);
        },
  
        // Cerrar el Modal
        cancelar() {
          this.dialogCheck = false;
          this.dialog = false;
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
            this.editarInventario(
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
  
        actualizarStock() {
          // Obten los Campos
          if (
            this.editado.CODE_PRODUCT == "" ||
            this.editado.NAME_PRODUCT == "" ||
            this.editado.UNIT_PRODUCT == "" ||
            this.editado.STOCK_EXIT == "" ||
            this.editado.STOCK == "" ||
            this.editado.DATE_INITIAL == "" ||
            this.editado.CATEGORY == "" ||
            this.editado.UNITARY_PRICE == ""
          ) {
            this.snackbar = true;
            this.textSnack = "Campos Vacios.";
          } else {
            this.ID_INVENTORY = this.editado.ID_INVENTORY;
            this.STOCK_EXIT = this.editado.STOCK_EXIT;
            this.STOCK = this.editado.STOCK;
  
            // Primero Modificame la Informacion
            this.editarStock(this.ID_INVENTORY, this.STOCK, this.STOCK_EXIT);
            // Luego de Todo Guardame la Salida
            this.guardarSalida();
          }
        },
  
        guardarSalida() {
          // Obten los Campos
          this.CODE_PRODUCT_EXIT = this.editado.CODE_PRODUCT;
          this.NAME_PRODUCT_EXIT = this.editado.NAME_PRODUCT;
          this.STOCK_EXIT = this.editado.STOCK_EXIT;
          this.UNITARY_PRICE_EXIT = this.editado.UNITARY_PRICE;
          this.UNIT_PRODUCT_EXIT = this.editado.UNIT_PRODUCT;
          this.CATEGORY_EXIT = this.editado.CATEGORY;
          this.STOCK_CURRENT = this.editado.STOCK;
          this.STOCK = this.editado.STOCK;
  
          this.guardarReporteSalida();
  
          this.snackbar = true;
          this.textSnack = "¡Verifica tu reporte!";
          this.cancelar();
        },
      },
    });
  });
  