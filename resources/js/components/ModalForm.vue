<template>
    <div id="overlay" v-on:click="clickEvent">
        <div id="content">
          <p><slot></slot></p>
          <button v-on:click="clickEvent">close</button>
        </div>
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
                    <input type="text" v-model="detail.address1" size="40">
                    <err-message :errors="errors" :name="'address1'" />
                </td>
            </tr>
            <tr>
                <th>住所2</th>
                <td>
                    <input type="text" v-model="detail.address2" size="40">
                    <err-message :errors="errors" :name="'address2'" />
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
  props: {
    loading: {
      type: Boolean,
      //default: false
    }
  },
  methods :{
    clickEvent: function(){
      this.$emit('from-child')
     }
  }
};
</script>

<style>
#content{
  z-index:10;
  width:50%;
  padding: 1em;
  background:#fff;
}

#overlay{
  /*　要素を重ねた時の順番　*/

  z-index:1;

  /*　画面全体を覆う設定　*/
  position:fixed;
  top:0;
  left:0;
  width:100%;
  height:100%;
  background-color:rgba(0,0,0,0.5);

  /*　画面の中央に要素を表示させる設定　*/
  display: flex;
  align-items: center;
  justify-content: center;

}
</style>