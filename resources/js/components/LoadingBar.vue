<template>
  <div class="fullview" v-if="isProcessing">
    <div class="progress-bar-bg fixed-top">
      <div class="progress-bar"></div>
    </div>
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
  watch: {
    loading: {
      immediate: true,
      handler() {
        this.processing();
      }
    }
  },
  data() {
    return {
      isProcessing: false
    };
  },
  methods: {
    processing() {
      if (this.loading == true) {
        this.isProcessing = true;
      } else {
        const dom = document.querySelector(".progress-bar");
        dom.style.animationPlayState = "paused";
        dom.style.animation = "none";
        dom.style.width = "100%";
        setTimeout(() => {
          this.isProcessing = false;
        }, 300);
      }
    }
  }
};
</script>

<style>
.fullview {
  width: 100%;
  height: 100%;
  z-index: 9900;
  background-color: rgba(255, 255, 255, 0.5);
  position: fixed;
  top: 0;
  left: 0;
}
.progress-bar-bg {
  width: 100%;
  height: 3px;
  background: #eee;
}
.progress-bar-bg .progress-bar {
  overflow: no-display;
  width: 0;
  height: 3px;
  background: #1496ed;
  background-position: 100px 100px;
  animation-name: moveIndeterminate;
  animation-duration: 5s;
  animation-timing-function: all 5s cubic-bezier(0.235, 0.285, 0.975, 0.055);
}
@keyframes moveIndeterminate {
  0% {
    width: 0;
  }
  10% {
    width: 15%;
  }
  100% {
    width: 100%;
  }
}
</style>