<template>
  <span>
      <button v-if="!news.liked_by_user" @click.prevent="likeChange" type="button" class="btn btn-secondary btn-sm">
        お気に入り登録
        <span class="badge badge-light">{{ news.likes_count }}</span>
      </button>
      <button v-if="news.liked_by_user" @click.prevent="likeChange" type="button" class="btn btn-primary btn-sm">
        お気に入り解除
        <span class="badge badge-light">{{ news.likes_count }}</span>
      </button>
  </span>
</template>

<script>
export default {
  props: {
    news: {
      type: Object,
    },
    detail: {
      type: Boolean,
      default:false
    },
  },
  methods: {
    async likeChange() {
      await this.$store.dispatch("like/likeChange", {
        id: this.news.id,
        liked: this.news.liked_by_user,
        detail: this.detail
      });
    }
  }
};
</script>