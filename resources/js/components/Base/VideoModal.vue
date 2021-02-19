<template>
  <Modal>
    <div class="video-modal">
      <div class="video-wrapper" v-click-away="closeModal">
        <iframe
          :src="`https://www.youtube.com/embed/${videoId}`"
          frameborder="0"
        >
        </iframe>
      </div>
    </div>
  </Modal>
</template>

<script>
import Modal from './Modal'

export default {
  name: 'AchievementVideoModal',
  components: {Modal},
  props: {
    videoId: {
      type: String,
      required: true,
    },
  },
  methods: {
    closeModal() {
      this.$emit('close-modal')
    },
  },
}
</script>

<style lang="scss" scoped>
@import "../../assets/scss/breakpoints";

.video-modal {
  height: 100vh;
  margin-top: -57px;
  display: flex;
  align-items: center;
  justify-content: center;

  @include landscape {
    height: initial;
    margin-top: initial;
  }

  @include tablets {
    height: 100%;
    margin-top: -13px;
  }
}

.video-wrapper {
  width: 100%;
  height: 0;
  position: relative;
  padding-bottom: 56.25%; // 16:9

  @media screen and (min-width: 1328px) {
    width: 1248px;
    padding-bottom: 708px;
  }

  iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
  }
}
</style>