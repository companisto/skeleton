function notify(msg){
	alert(msg)
}

function log(msg){
	console.log(msg)
}

export default {
	notify: notify,
	log: log
}

//function notify(message){

// ES2015
// export default function (message){
// 	alert(message);
// }


// ES2015 export specific function
//export function notify (message){...
// in app.js then you have to import {notify} from "./Notification"


// CommonJS
// module.exports = function(message){
// 	alert(message);
// }


