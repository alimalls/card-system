(window.webpackJsonp=window.webpackJsonp||[]).push([["chunk-520bbfda"],{"967f":function(e,t,n){"use strict";n.d(t,"c",(function(){return a})),n.d(t,"h",(function(){return o})),n.d(t,"d",(function(){return i})),n.d(t,"i",(function(){return s})),n.d(t,"a",(function(){return c})),n.d(t,"f",(function(){return u})),n.d(t,"g",(function(){return d})),n.d(t,"b",(function(){return l})),n.d(t,"e",(function(){return m}));var r=n("41bb");function a(e){return Object(r.a)({url:"system/info",method:e?"post":"get",data:e})}function o(e){return Object(r.a)({url:"system/theme",method:e?"post":"get",data:e})}function i(e){return Object(r.a)({url:"system/order",method:e?"post":"get",data:e})}function s(e){return Object(r.a)({url:"system/vcode",method:e?"post":"get",data:e})}function c(e){return Object(r.a)({url:"system/email",method:e?"post":"get",data:e})}function u(e){return Object(r.a)({url:"system/sms",method:e?"post":"get",data:e})}function d(e){return Object(r.a)({url:"system/storage",method:e?"post":"get",data:e})}function l(e){return Object(r.a)({url:"system/email/test",method:"post",data:{to:e}})}function m(e){return Object(r.a)({url:"system/order/clean",method:"post",data:{day:e}})}},f2c9:function(e,t,n){"use strict";n.r(t);var r=n("323e"),a=n.n(r),o=n("967f"),i={components:{},data:function(){return{loading:!1,labelWidth:"0px",form:{order_query_day:30,order_clean_unpay_open:0,order_clean_unpay_day:7},formRules:{order_query_day:[{required:!0,message:"请输入订单查询最长天数",trigger:"blur"}]}}},watch:{loading:function(e,t){e?t||a.a.isStarted()||a.a.start():a.a.done()}},mounted:function(){this.getSet()},methods:{getSet:function(){var e=this;this.loading=!0,Object(o.d)().then((function(t){Object.assign(e.form,t.data),e.loading=!1}))},handleResetForm:function(){this.getSet()},handleSubmit:function(){var e=this;this.$refs.form.validate((function(t){t&&(e.loading=!0,Object(o.d)(e.form).then((function(){e.loading=!1,e.$notify({title:"操作成功",message:"配置保存成功",type:"success"})})).catch((function(){e.loading=!1})))}))},clearOrder:function(){var e=this;this.$confirm("是否要删除 ".concat(this.form.order_clean_unpay_day,"天 前未支付订单?")).then((function(){Object(o.e)(e.form.order_clean_unpay_day).then((function(){e.$notify({title:"成功",message:"".concat(e.form.order_clean_unpay_day,"天 前未支付订单已删除"),type:"success"})}))}))}}},s=n("2877"),c=Object(s.a)(i,(function(){var e=this,t=e.$createElement,n=e._self._c||t;return n("el-card",[n("el-form",{directives:[{name:"loading",rawName:"v-loading.body",value:e.loading,expression:"loading",modifiers:{body:!0}}],ref:"form",attrs:{model:e.form,"label-width":e.labelWidth,rules:e.formRules}},[n("h2",{staticClass:"title"},[e._v("订单设置")]),n("el-form-item",{staticClass:"item-container",attrs:{prop:"order_query_day"}},[n("span",[e._v("订单查询最长天数")]),n("el-input",{attrs:{type:"number",placeholder:"请输入订单查询最长天数"},model:{value:e.form.order_query_day,callback:function(t){e.$set(e.form,"order_query_day",t)},expression:"form.order_query_day"}}),n("span",{staticClass:"tip"},[e._v("买家将无法查询超过此天数的订单")])],1),n("el-form-item",{staticClass:"item-container"},[n("el-switch",{attrs:{"inactive-text":"清理未支付订单","active-value":1,"inactive-value":0},model:{value:e.form.order_clean_unpay_open,callback:function(t){e.$set(e.form,"order_clean_unpay_open",t)},expression:"form.order_clean_unpay_open"}})],1),n("el-form-item",{directives:[{name:"show",rawName:"v-show",value:e.form.order_clean_unpay_open,expression:"form.order_clean_unpay_open"}],staticClass:"item-container",attrs:{prop:"order_clean_unpay_day",rules:{required:!0,message:"请输入未支付订单保留天数",trigger:"blur"}}},[n("span",[e._v("未支付订单保留天数")]),n("el-input",{attrs:{type:"number",placeholder:"请输入未支付订单保留天数"},model:{value:e.form.order_clean_unpay_day,callback:function(t){e.$set(e.form,"order_clean_unpay_day",t)},expression:"form.order_clean_unpay_day"}}),n("span",{staticClass:"tip"},[e._v("超过此天数的未支付订单将被删除")])],1),n("div",{directives:[{name:"show",rawName:"v-show",value:e.form.order_clean_unpay_open,expression:"form.order_clean_unpay_open"}],staticStyle:{"font-size":"12px"}},[n("span",[e._v("注意: 本功能需要开启定时任务")]),n("code",{staticStyle:{display:"block"}},[e._v(" * * * * * php /www/wwwroot/card_dist/artisan schedule:run >> /dev/null 2>&1 & echo 'card_job';")]),n("br"),e._v(" 你也可以点此 "),n("el-button",{attrs:{size:"mini"},on:{click:e.clearOrder}},[e._v("手动清理")])],1)],1),n("div",{staticClass:"text-center",staticStyle:{"margin-top":"24px"}},[n("el-button",{on:{click:e.handleResetForm}},[e._v("刷新")]),n("el-button",{attrs:{type:"primary",loading:e.loading},nativeOn:{click:function(t){return e.handleSubmit(t)}}},[e._v("保存更改")])],1)],1)}),[],!1,null,null,null);t.default=c.exports}}]);