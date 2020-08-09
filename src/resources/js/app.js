/**
 * 独自で実装したComponentを下記にて取り込む
 */
import VueRouter from 'vue-router';
// メニュー関係
import HeaderComponent from "./components/HeaderComponent";
import MenuComponent from "./components/MenuComponent";
// 経費関係
import CostMenuComponent from "./components/cost/CostMenuComponent";
import CostRecordComponent from "./components/cost/CostRecordComponent";
import CostRecordDoneComponent from "./components/cost/CostRecordDoneComponent";
import CostListComponent from "./components/cost/CostListComponent";
import CostDetailComponent from "./components/cost/CostDetailComponent";
import SelectYearMonthComponent from "./components/cost/SelectYearMonthComponent";
import CostEditComponent from "./components/cost/CostEditComponent";
import CostEditDoneComponent from "./components/cost/CostEditDoneComponent";
import CostDeleteDoneComponent from "./components/cost/CostDeleteDoneComponent";
// 時間関係
import HourMenuComponent from "./components/hour/HourMenuComponent";
import HourRecordComponent from "./components/hour/HourRecordComponent";
import HourRecordDoneComponent from "./components/hour/HourRecordDoneComponent";
import SelectYearHourComponent from "./components/hour/SelectYearComponent";
import HourListComponent from "./components/hour/HourListComponent";
// 収入関係
import SalaryMenuComponent from "./components/salary/SalaryMenuComponent";
import SalaryRecordComponent from "./components/salary/SalaryRecordComponent";
import SalaryRecordDoneComponent from "./components/salary/SalaryRecordDoneComponent";
import SelectYearSalaryComponent from "./components/salary/SelectYearComponent";
import SalaryListComponent from "./components/salary/SalaryListComponent";
// その他の機能
import OtherMenuComponent from "./components/other/OtherMenuComponent";
import DumpDatabaseComponent from "./components/other/DumpDatabaseComponent";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        /*
        |--------------------------------------------------------------------------
        | Menu routes
        |--------------------------------------------------------------------------
        | メニュー関係のルーティングは下記にて実装 */
        { /* メニュー */ path: '/menus/', name: 'saisan.menus', component: MenuComponent },
        /*
        |--------------------------------------------------------------------------
        | Cost routes
        |--------------------------------------------------------------------------
        | 経費ノ部のルーティングは下記にて実装 */
        { /* 経費トップ */ path: '/cost/', name: 'saisan.cost', component: CostMenuComponent },
        { /* 経費計上 */ path: '/cost/rec/', name: 'cost.rec', component: CostRecordComponent },
        { /* 経費計上完了 */ path: '/cost/rec-done/', name: 'cost.rec-done', component: CostRecordDoneComponent },
        { /* 経費計上個別データの参照 */ path: '/cost/detail/:costId/', name: 'cost.detail', component: CostDetailComponent, props: true },
        { /* 経費計上年月日の取得 */ path: '/cost/list/select-ym/', name: 'cost.list.selectym', component: SelectYearMonthComponent },
        { /* 経費計上リスト(日次) */ path: '/cost/list/:year/:month/:day/', name: 'cost.list-day', component: CostListComponent, props: true },
        { /* 経費計上リスト(月次) */ path: '/cost/list/:year/:month/', name: 'cost.list-month', component: CostListComponent, props: true },
        { /* 経費計上明細の修正 */ path: '/cost/edit/:costId/', name: 'cost.edit', component: CostEditComponent, props: true },
        { /* 経費計上明細の修正完了 */ path: '/cost/edit-done/:costId/', name: 'cost.edit-done', component: CostEditDoneComponent, props: true },
        { /* 経費計上明細の削除完了 */ path: '/cost/delete-done/:costId/', name: 'cost.delete-done', component: CostDeleteDoneComponent, props: true },
        /*
        |--------------------------------------------------------------------------
        | Hour routes
        |--------------------------------------------------------------------------
        | 時間ノ部のルーティングは下記にて実装 */
        { /* 時間トップ */ path: '/hour/', name: 'saisan.hour', component: HourMenuComponent },
        { /* 時間計上 */ path: '/hour/rec/', name: 'hour.rec', component: HourRecordComponent },
        { /* 時間計上完了 */ path: '/hour/rec-done/', name: 'hour.rec-done', component: HourRecordDoneComponent },
        { /* 時間計上年の取得 */ path: '/hour/list/select-y/', name: 'hour.list.selecty', component: SelectYearHourComponent },
        { /* 時間計上リスト（年次） */ path: '/hour/list/:year/', name: 'hour.list', component: HourListComponent, props: true },
        /*
        |--------------------------------------------------------------------------
        | Salary routes
        |--------------------------------------------------------------------------
        | 収入ノ部のルーティングは下記にて実装 */
        { /* 収入トップ */ path: '/salary/', name: 'saisan.salary', component: SalaryMenuComponent },
        { /* 収入計上 */ path: '/salary/rec/', name: 'salary.rec', component: SalaryRecordComponent },
        { /* 収入計上 */ path: '/salary/rec-done/', name: 'salary.rec-done', component: SalaryRecordDoneComponent },
        { /* 収入計上年の取得 */ path: '/salary/list/select-y/', name: 'salary.list.selecty', component: SelectYearSalaryComponent },
        { /* 収入計上リスト（年次） */ path: '/salary/list/:year/', name: 'salary.list', component: SalaryListComponent, props: true },
        /*
        |--------------------------------------------------------------------------
        | Others routes
        |--------------------------------------------------------------------------
        | その他ノ部のルーティングは下記にて実装 */
        { /* その他トップ */ path: '/other/', name: 'saisan.other', component: OtherMenuComponent },
        { /* データベースのダンプコマンド出力 */ path: '/other/dump/', name: 'other.dump', component: DumpDatabaseComponent },
    ]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-component', HeaderComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
