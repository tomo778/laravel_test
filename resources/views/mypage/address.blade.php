@extends('layout.index')
@section('title', 'mypageu')
@section('description', 'description')
@section('body')
<h3>住所一覧</h3>
@if ($data->isEmpty())
<p><a href="{{ route('mypage_create')}}" class="btn btn-primary">住所登録</a></p>
<br>
@else
<p><a href="{{ route('mypage_create')}}" class="btn btn-primary">住所追加</a></p>
<br>
<div id="vue" v-cloak>
    <table class="table" v-for="it in items" :key="it.id">
        <tr>
            <th width="100"><a href="" v-on:click.prevent="update(it.id)">更新</a></th>
            <td>
                〒@{{it.zip1}}-@{{it.zip2}}<br>
                @{{it.PrefText}}<br>
                @{{it.address1}} @{{it.address2}}
            </td>
        </tr>
    </table>
    <div>
        <loading-bar :loading="loading" />
    </div>
    <div id="overlay" v-if="show">
        <div id="overlay_content">
            <h3>住所更新</h3>
            <table class="table">
                <tr>
                    <th>郵便番号</th>
                    <td>
                        <input type="text" v-model="detail.zip1" size="10">
                        -
                        <input type="text" v-model="detail.zip2" size="10">
                        <span>
                            <err-message :errors="errors" :name="'zip1'" />
                        </span>
                        <span>
                            <err-message :errors="errors" :name="'zip2'" />
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>都道府県</th>
                    <td>
                        <select name="pref" v-model="detail.pref">
                            @foreach (Config::get('const.pref') as $k2 => $v2)
                            <option value="{{$k2}}">{{$v2}}</option>
                            @endforeach
                        </select>
                        <err-message :errors="errors" :name="'pref'" />
                    </td>
                </tr>
                <tr>
                    <th>住所1</th>
                    <td>
                        <input type="text" v-model="detail.address1">
                        <err-message :errors="errors" :name="'address1'" />
                    </td>
                </tr>
                <tr>
                    <th>住所2</th>
                    <td>
                        <input type="text" v-model="detail.address2">
                        <err-message :errors="errors" :name="'address2'" />
                    </td>
                </tr>
            </table>
            <div>
                <a href="" v-on:click.prevent="update_exe" class="btn btn-primary">更新</a>
                <a href="" v-on:click.prevent="retrun" class="btn btn-primary">戻る</a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
@section('script')
<script src=" {{ mix('js/app.js') }} "></script>
<script>
    // Vue
    new Vue({
        el: '#vue',
        data() {
            return {
                loading: false,
                show: false,
                items: {},
                detail: {},
                errors: {},
            };
        },
        created() {
            this.init();
        },
        methods: {
            async init() {
                this.loading = true;
                const response = await axios.get(`/api/address`);
                this.items = response.data;
                this.loading = false;
            },
            async update(id) {
                this.errors = {};
                this.loading = true;
                const response = await axios.post(`/api/address/update`, {
                    id: id
                });
                this.loading = false;
                if (response.status == 422) {
                    return false;
                }
                this.detail = response.data;
                this.show = true;
            },
            async update_exe() {
                this.loading = true;
                const response = await axios.post(`/api/address/update_exe`, this.detail);
                this.loading = false;
                if (response.status == 422) {
                    this.errors = response.data.errors;
                    return false;
                }
                this.init();
                this.show = false;
            },
            retrun() {
                this.show = false;
            },
        }
    });
</script>
@endsection