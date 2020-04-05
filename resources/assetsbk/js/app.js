
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const STATUS = {1:'公開',0:'非公開'};

// const app = new Vue({
// 	el: '#app',
// 	data:{
// 		status: STATUS,
// 		//loading: true,
// 		todos: [],
// 		checkedNames: [],
// 		tmp: [],
// 		showText: false
// 	},
// 	// created () {
// 	//     axios.get('/api/get').then((res)=>{
// 	//         for (var k in res.data) {
// 	//             this.tmp.push(res.data[k]['id']);
// 	//         }
// 	//       this.todos = res.data;
// 	//       this.loading = false;
// 	//
// 	//     })
// 	// },
// 	methods: {
// 		fontColor: function(loop) {
// 			if (loop === 1) {
// 				return false;
// 			} else {
// 				return true;
// 			}
// 		},
// 	fetchTodos: function(k){
// 	  axios.post('/api/up', {va:k, ar:this.checkedNames}).then((res)=>{
// 		this.checkedNames = [];
// 		this.showText == false;
// 	  })
// 	},
// 	selectAll: function(){
// 		if($.inArray('all', this.checkedNames) >= 0){
// 			this.checkedNames = [];
// 		} else {
// 			for (var k in this.tmp) {
// 				this.checkedNames.push(this.tmp[k]);
// 			}
// 		}
// 	},
// 	}
// });

const app = new Vue({
	el: '#app',
	data:{

		//loading: true,
		todos: [],
		checkedNames: [],
		form_val: [],
		showText: false
	},
	methods: {
		update: function(){
			this.form_val = $('#my-form').serialize();
			event.preventDefault();
			axios.post('/admin/news/edit/update/', this.form_val).then((res)=>{
				console.log(res.data);
			})
		},
        create: function(){
			this.form_val = $('#my-form').serialize();
			event.preventDefault();
			axios.post('/admin/news/edit/create/', this.form_val).then((res)=>{
				console.log(res.id);
			})
		},
	}
});
