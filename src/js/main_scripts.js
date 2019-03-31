//import 'bootstrap';
require('bootstrap');

window.$ = require('jquery');
var dt = require('datatables.net');
require('datatables.net-bs4');
window.$.DataTable = dt;

// import dt from 'datatables.net';
// import('datatables.net-bs4')

//import 'datatables.net';
//import 'datatables.net-bs4';



//import style_css from "./../scss/test.css";
//import style_scss from "./../scss/test.scss"


class TestingForm{
	constructor(){
		console.log("Testing form constructor");
	}
}

new TestingForm();

// require("./../scss/test.css");
// import notification from "./Notification";

// notification.notify("Good test notification");

// ES2015
//import notify from "./Notification"

//import from node_module
//import notify from "some-node-pacakge"

//	CommonJS
//var notify = require("./Notification");

//notify("Here is my NEW message");