(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-2d0e59ef"],{"94ec":function(t,e,s){"use strict";s.r(e);s("d81d"),s("4de4"),s("d3b7");var a=function(){var t=this,e=t._self._c;return e("div",{staticClass:"withdraw"},[e("h4",{staticClass:"fw-bold py-3 mb-4 d-flex"},[e("span",{staticClass:"mr-auto"},[t._v(" "+t._s(t.$trans("Payout"))+" ")]),e("button",{staticClass:"btn btn-outline-primary btn-sm mr-3",on:{click:function(e){t.formFilter=!t.formFilter}}},[e("svg",{staticClass:"css-i6dzq1 mr-1",attrs:{viewBox:"0 0 24 24",width:"16",height:"16",stroke:"currentColor","stroke-width":"2",fill:"none","stroke-linecap":"round","stroke-linejoin":"round"}},[e("polygon",{attrs:{points:"22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"}})]),t._v(" "+t._s(t.$trans("Filter"))+" ")])]),t.formFilter?e("div",{staticClass:"form-filter mb-3 card"},[e("div",{staticClass:"card-body"},[e("div",{staticClass:"d-flex"},[e("div",{staticClass:"form-group mr-3"},[e("label",{staticClass:"d-block"},[t._v(t._s(t.$trans("Keyword")))]),e("input",{directives:[{name:"model",rawName:"v-model",value:t.filterQuery.keyword,expression:"filterQuery.keyword"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.filterQuery.keyword},on:{input:function(e){e.target.composing||t.$set(t.filterQuery,"keyword",e.target.value)}}})]),e("div",{staticClass:"form-group mr-3"},[e("label",{staticClass:"d-block"},[t._v(t._s(t.$trans("Method")))]),e("select",{directives:[{name:"model",rawName:"v-model",value:t.filterQuery.method,expression:"filterQuery.method"}],staticClass:"form-control w-200",on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.filterQuery,"method",e.target.multiple?s:s[0])}}},[e("option",{attrs:{value:"all"}},[t._v(t._s(t.$trans("All")))]),e("option",{attrs:{value:"BANK"}},[t._v(t._s(t.$trans("BANK")))]),e("option",{attrs:{value:"MOMO"}},[t._v(t._s(t.$trans("MOMO")))]),e("option",{attrs:{value:"ZALO"}},[t._v(t._s(t.$trans("ZALO")))])])]),e("div",{staticClass:"form-group mr-3"},[e("label",{staticClass:"d-block"},[t._v(t._s(t.$trans("Status")))]),e("select",{directives:[{name:"model",rawName:"v-model",value:t.filterQuery.status,expression:"filterQuery.status"}],staticClass:"form-control w-200",on:{change:function(e){var s=Array.prototype.filter.call(e.target.options,(function(t){return t.selected})).map((function(t){var e="_value"in t?t._value:t.value;return e}));t.$set(t.filterQuery,"status",e.target.multiple?s:s[0])}}},[e("option",{attrs:{value:"all"}},[t._v(t._s(t.$trans("All")))]),t._l(t.payout_status,(function(s,a){return e("option",{key:a,domProps:{value:a}},[t._v(t._s(s))])}))],2)])]),e("div",{staticClass:"d-flex mb-3"},[e("div",{staticClass:"form-group mr-3"},[e("label",{staticClass:"d-block"},[t._v(t._s(t.$trans("From")))]),e("date-picker",{staticClass:"w-200",model:{value:t.filterQuery.from,callback:function(e){t.$set(t.filterQuery,"from",e)},expression:"filterQuery.from"}})],1),e("div",{staticClass:"form-group mr-3"},[e("label",{staticClass:"d-block"},[t._v(t._s(t.$trans("To")))]),e("date-picker",{staticClass:"w-200",model:{value:t.filterQuery.to,callback:function(e){t.$set(t.filterQuery,"to",e)},expression:"filterQuery.to"}})],1)]),e("div",{staticClass:"filter-actions d-flex"},[e("button",{staticClass:"btn btn-outline-danger btn-sm mr-3",on:{click:t.reset_filter}},[t._v(t._s(t.$trans("Reset")))]),e("button",{staticClass:"btn btn-outline-primary btn-sm mr-3",on:{click:t.filter}},[t.process_loading?e("div",{staticClass:"spinner-border spinner-border-sm text-secondary"}):t._e(),t._v(" "+t._s(t.$trans("Apply"))+" ")]),t.json_data&&t.json_data.length?e("download-csv",{attrs:{labels:t.labels,data:t.json_data,name:t.export_file_name}},[e("button",{staticClass:"btn btn-sm btn-primary"},[t._v(t._s(t.$trans("Download")))])]):e("button",{staticClass:"btn btn-primary btn-sm mr-3",on:{click:t.export_transaction}},[t.process_export_loading?e("div",{staticClass:"spinner-border spinner-border-sm text-secondary"}):t._e(),t._v(" "+t._s(t.$trans("Export"))+" ")])],1)])]):t._e(),e("div",{staticClass:"card"},[e("div",{staticClass:"card-body"},[t.transactions&&t.transactions.data?t._t("default",(function(){return[e("div",{staticClass:"table-responsive"},[e("div",{staticClass:"list-info mb-3"},[e("small",[t._v(" "+t._s(t.$trans("Results"))+": "),e("strong",[t._v(t._s(t.transactions.data.length))]),t._v(" "+t._s(t.$trans("of"))+" "),e("strong",[t._v(" "+t._s(t.transactions.total)+" ")])])]),e("table",{staticClass:"table table-striped"},[e("thead",[e("tr",[e("th",[t._v(t._s(t.$trans("Ref Number")))]),e("th",[t._v(t._s(t.$trans("Order ID")))]),e("th",[t._v(t._s(t.$trans("Receiver")))]),e("th",{staticClass:"text-right"},[t._v(t._s(t.$trans("Amount")))]),e("th",{staticClass:"text-right"},[t._v(t._s(t.$trans("Fee")))]),e("th",[t._v(t._s(t.$trans("Date")))]),e("th",[t._v(t._s(t.$trans("Finish Time")))]),e("th",[t._v(t._s(t.$trans("Time elapsed")))]),e("th",[t._v(t._s(t.$trans("Status")))]),e("th",[t._v(t._s(t.$trans("Note")))])])]),e("tbody",t._l(t.transactions.data,(function(s,a){return e("tr",{key:a},[e("td",[t._v(t._s(s.ref_number))]),e("td",[t._v(t._s(s.order_id))]),e("td",["BANK"==s.method?t._t("default",(function(){return[e("span",{staticClass:"d-block"},[t._v("["),e("strong",[t._v("BANK - "+t._s(s.receiver.bank_code))]),t._v("] "+t._s(t.payout_banks[s.receiver.bank_code]))])]})):e("span",{staticClass:"d-block"},[t._v("["),e("strong",[t._v(t._s(s.method))]),t._v("]")]),t._v(" "+t._s(s.receiver.account_number)+" - "+t._s(s.receiver.account_name)+" ")],2),e("td",{staticClass:"text-right text-success"},[e("vue-numeric",{attrs:{"currency-symbol-position":"suffix",currency:"",value:s.amount,"read-only":!0,precision:0}})],1),e("td",{staticClass:"text-right text-success"},[e("vue-numeric",{attrs:{"currency-symbol-position":"suffix",currency:"",value:s.fee,"read-only":!0,precision:0}})],1),e("td",[t._v(t._s(s.created_at))]),e("td",[s.finish_time?t._t("default",(function(){return[t._v(t._s(s.finish_time))]})):t._t("default",(function(){return[t._v("-")]}))],2),e("td",[s.time_elapsed?t._t("default",(function(){return[e("vue-numeric",{attrs:{"currency-symbol-position":"suffix",currency:"min",value:s.time_elapsed,"read-only":!0,precision:2}})]})):t._t("default",(function(){return[t._v("-")]}))],2),e("td",[1==s.status?e("span",{staticClass:"badge badge-success badge-pill"},[t._v(" "+t._s(t.$trans("Success"))+" ")]):t._e(),2==s.status?e("span",{staticClass:"badge badge-warning badge-pill"},[t._v(" "+t._s(t.$trans("Pending"))+" ")]):t._e(),3==s.status?e("span",{staticClass:"badge badge-info badge-pill"},[t._v(" "+t._s(t.$trans("Processing"))+" ")]):t._e(),0==s.status?e("span",{staticClass:"badge badge-warning badge-pill"},[t._v(" "+t._s(t.$trans("Hold"))+" ")]):t._e(),-1==s.status?e("span",{staticClass:"badge badge-danger badge-pill"},[t._v(" "+t._s(t.$trans("Reject"))+" ")]):t._e(),s.status<-1?t._t("default",(function(){return[-2==s.status?e("span",{staticClass:"badge badge-dark badge-pill"},[t._v(" "+t._s(t.payout_status[s.status])+" ")]):e("span",{staticClass:"badge badge-danger badge-pill"},[t._v(" "+t._s(t.payout_status[s.status])+" ")])]})):t._e()],2),e("td",[t._v(t._s(s.note))])])})),0)])]),t.transactions&&t.transactions.data&&t.transactions.last_page?e("paginate",{attrs:{"page-count":t.transactions.last_page,"click-handler":t.paginate,"prev-text":t.$trans("Previous"),"next-text":t.$trans("Next"),"page-class":"page-item","prev-class":"page-item","next-class":"page-item","page-link-class":"page-link","prev-link-class":"page-link","next-link-class":"page-link","container-class":"pagination"}}):t._e()]})):t._e()],2)])])},r=[],n=(s("159b"),s("14d9"),s("bc3a")),i=s.n(n),o=s("c1df"),l=s.n(o),c={name:"Payout",data:function(){return{transactions:null,filterQuery:{page:1,from:null,to:new Date,method:"all",keyword:"",status:"all"},transaction:null,showDetail:!1,tabActive:"detail",errors:{},process:!1,alert:null,process_reject:!1,process_re_payout:!1,note:"",formFilter:!1,process_loading:!1,export_data:null,process_export_loading:null,labels:{ref_number:"REF NUMBER",method:"METHOD",order_id:"ORDER ID",receiver:"RECEIVER",amount:"AMOUNT",fee:"FEE",date:"DATE",finish_time:"FINISH TIME",time_elapsed:"TIME ELAPSED (MIN)",status:"STATUS",note:"NOTE"}}},mounted:function(){var t=new Date;this.filterQuery.from=new Date(t.getFullYear(),t.getMonth(),1)},methods:{filter:function(){this.filterQuery.page=1,this.index()},paginate:function(t){this.filterQuery.page=t,this.index()},index:function(){var t=this;this.process_loading=!0,i()({url:this.$root.$data.api_url+"/api/client/payout/transactions",params:this.filterQuery,method:"GET"}).then((function(e){t.transactions=e.data,t.process_loading=!1})).catch((function(e){console.log(e),t.process_loading=!1}))},export_transaction:function(){var t=this;this.process_export_loading=!0,i()({url:this.$root.$data.api_url+"/api/client/payout/export",params:this.filterQuery,method:"GET"}).then((function(e){t.export_data=e.data,t.process_export_loading=!1})).catch((function(e){console.log(e),t.process_export_loading=!1}))},reset_filter:function(){var t=new Date;this.filterQuery={from:new Date(t.getFullYear(),t.getMonth(),1),to:new Date,page:1,method:"all",keyword:"",status:"all"},this.export_data=null,this.index()}},created:function(){this.index()},computed:{payout_status:function(){return this.$root.$data.global_settings.payout_status},payout_banks:function(){return this.$root.$data.global_settings.payout_banks},json_data:function(){var t=this,e=[];if(this.export_data){var s=this.export_data;s.forEach((function(s){var a="-",r=t.payout_status[s.status];a="BANK"==s.method?"[BANK - "+s.receiver.bank_code+"] "+t.payout_banks[s.receiver.bank_code]+"("+s.receiver.account_number+" - "+s.receiver.account_name+")":"["+s.method+"] "+s.receiver.account_number+" - "+s.receiver.account_name;var n={ref_number:s.ref_number,method:s.method,order_id:s.order_id,receiver:a,amount:s.amount,fee:s.fee,date:s.created_at,finish_time:s.finish_time,time_elapsed:s.time_elapsed,status:r,note:s.note};e.push(n)}))}return e},export_file_name:function(){var t="",e="";return t=l()(this.filterQuery.from).format("YYYY-MM-DD"),e=l()(this.filterQuery.to).format("YYYY-MM-DD"),"payout-transactions-"+t+"-"+e+".csv"}}},u=c,d=s("2877"),_=Object(d["a"])(u,a,r,!1,null,"7bc0632a",null);e["default"]=_.exports}}]);
//# sourceMappingURL=chunk-2d0e59ef.5c761f0d.js.map