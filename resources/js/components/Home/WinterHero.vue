<template>
  <div @mousemove="handleMouseMove" class="winter-hero" ref="hero">
    <img src="/img/hero/winter/cloud-left.png" class="winter-hero__cloud-left" alt="Cloud" ref="cloudLeft"/>
    <img src="/img/hero/winter/cloud-right.png" class="winter-hero__cloud-right" alt="Cloud" ref="cloudRight"/>
    <img src="/img/hero/winter/bg3.png" class="winter-hero__bg3" alt="Mountains" ref="mountains"/>

    <svg class="logo-back" viewBox="0 0 238 40" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M37.6513 20.5479V0H30.2309V20.0913C30.2309 26.484 35.2694 31.7808 41.6821 32.0548V24.6575C39.5751 24.3836 37.8345 22.7397 37.6513 20.5479Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M7.60354 9.58904C9.34411 8.6758 11.2679 8.12785 13.3749 8.12785C20.0624 8.12785 25.4673 13.4247 25.4673 20.0913C25.4673 26.758 20.0624 32.1461 13.3749 32.1461C11.2679 32.1461 9.34411 31.5982 7.60354 30.6849V31.5982H0V0.0913242H7.60354V9.58904ZM7.60354 20.0913C7.60354 23.2877 10.1686 25.8447 13.3749 25.8447C16.5812 25.8447 19.1463 23.2877 19.1463 20.0913C19.1463 16.895 16.5812 14.3379 13.3749 14.3379C10.1686 14.3379 7.60354 16.895 7.60354 20.0913Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M63.0269 9.58904C61.2864 8.6758 59.3626 8.12785 57.2556 8.12785C50.5681 8.12785 45.1632 13.516 45.1632 20.1826C45.1632 26.8493 50.5681 32.2374 57.2556 32.2374C59.3626 32.2374 61.2864 31.6895 63.0269 30.7763V31.6895H69.8976V8.85845H63.0269V9.58904ZM57.2556 25.8447C54.0493 25.8447 51.4842 23.2877 51.4842 20.0913C51.4842 16.895 54.0493 14.3379 57.2556 14.3379C60.4619 14.3379 63.0269 16.895 63.0269 20.0913C63.0269 23.2877 60.4619 25.8447 57.2556 25.8447Z"/>
      <path
        d="M134.574 15.4338C134.482 16.0731 135.123 16.5297 136.222 16.7123C140.162 17.2603 144.65 19.2694 144.65 24.0183C144.65 29.7717 139.154 31.6895 135.398 31.6895C132.467 31.6895 128.985 30.8676 126.329 27.3059L129.718 23.0137C131.276 24.6575 133.383 25.3881 135.032 25.4795C136.406 25.4795 137.139 25.0228 137.139 24.3836C137.139 23.8356 136.681 23.2877 135.306 23.105C131.367 22.6484 127.153 20.1826 127.153 15.5251C127.153 10.5936 131.734 8.12785 136.131 8.12785C138.055 8.12785 141.169 8.40183 143.918 11.3242L140.436 15.7078C138.696 14.4292 136.955 14.3379 136.314 14.3379C135.215 14.3379 134.574 14.8858 134.574 15.4338Z"/>
      <path
        d="M233.969 14.1553V20.7306C234.244 22.831 235.893 24.4749 238 24.7489V32.1461C231.679 31.7808 226.549 26.5753 226.549 20.1826V14.1553H223.526V8.49315H226.549V3.28767L233.969 2.55708V8.49315H237.725V14.1553H233.969Z"/>
      <path
        d="M206.761 8.6758H214.365V9.95434C215.831 9.13242 217.663 8.6758 219.495 8.6758V14.4292C217.022 14.4292 214.915 16.1644 214.365 18.5388V31.5069H206.761V8.6758Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M178.546 20.1826C178.546 13.516 183.951 8.12785 190.638 8.12785C197.326 8.12785 202.731 13.4247 202.731 20.1826C202.731 26.8493 197.326 32.2374 190.638 32.2374C183.951 32.2374 178.546 26.8493 178.546 20.1826ZM184.867 20.0913C184.867 23.2877 187.432 25.8447 190.638 25.8447C193.844 25.8447 196.41 23.2877 196.41 20.0913C196.41 16.895 193.844 14.3379 190.638 14.3379C187.432 14.3379 184.867 16.895 184.867 20.0913Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M162.331 8.12785C160.224 8.12785 158.209 8.6758 156.56 9.58904V8.6758H148.956V40H156.56V30.5936C158.3 31.5069 160.224 32.0548 162.331 32.0548C169.018 32.0548 174.423 26.6667 174.423 20C174.423 13.4247 169.018 8.12785 162.331 8.12785ZM162.331 25.8447C159.125 25.8447 156.56 23.2877 156.56 20.0913C156.56 16.895 159.125 14.3379 162.331 14.3379C165.537 14.3379 168.102 16.895 168.102 20.0913C168.102 23.2877 165.537 25.8447 162.331 25.8447Z"/>
      <path
        d="M86.3872 14.3379C87.7614 14.3379 89.0439 14.7945 90.0516 15.6164L94.5404 11.1416C92.4334 9.22374 89.5935 8.03653 86.3872 8.03653C79.6998 8.03653 74.2948 13.4247 74.2948 20.0913C74.2948 26.758 79.6998 32.1461 86.3872 32.1461C89.5019 32.1461 92.3418 30.9589 94.5404 29.0411L90.0516 24.5662C89.0439 25.3881 87.7614 25.8447 86.3872 25.8447C83.1809 25.8447 80.6159 23.2877 80.6159 20.0913C80.6159 16.895 83.1809 14.3379 86.3872 14.3379Z"/>
      <path
        d="M106.358 18.5388L116.252 8.6758H124.405L112.771 20.1826L124.13 31.5068H113.962L107.64 25.2968L106.358 26.5753V31.5068H98.9376V0H106.358V18.5388Z"/>
    </svg>

    <img src="/img/hero/winter/bg2.png" class="winter-hero__bg2" alt="Hill" ref="middleMountains"/>
    <img src="/img/hero/winter/bg1.png" class="winter-hero__bg1" alt="Hill" ref="frontMountains"/>
    <img src="/img/hero/winter/man.png" class="winter-hero__man" alt="Man" ref="man"/>

    <div class="logo-mask" ref="logoMask">
      <svg class="logo-mask__logo" viewBox="0 0 238 40" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M37.6513 20.5479V0H30.2309V20.0913C30.2309 26.484 35.2694 31.7808 41.6821 32.0548V24.6575C39.5751 24.3836 37.8345 22.7397 37.6513 20.5479Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M7.60354 9.58904C9.34411 8.6758 11.2679 8.12785 13.3749 8.12785C20.0624 8.12785 25.4673 13.4247 25.4673 20.0913C25.4673 26.758 20.0624 32.1461 13.3749 32.1461C11.2679 32.1461 9.34411 31.5982 7.60354 30.6849V31.5982H0V0.0913242H7.60354V9.58904ZM7.60354 20.0913C7.60354 23.2877 10.1686 25.8447 13.3749 25.8447C16.5812 25.8447 19.1463 23.2877 19.1463 20.0913C19.1463 16.895 16.5812 14.3379 13.3749 14.3379C10.1686 14.3379 7.60354 16.895 7.60354 20.0913Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M63.0269 9.58904C61.2864 8.6758 59.3626 8.12785 57.2556 8.12785C50.5681 8.12785 45.1632 13.516 45.1632 20.1826C45.1632 26.8493 50.5681 32.2374 57.2556 32.2374C59.3626 32.2374 61.2864 31.6895 63.0269 30.7763V31.6895H69.8976V8.85845H63.0269V9.58904ZM57.2556 25.8447C54.0493 25.8447 51.4842 23.2877 51.4842 20.0913C51.4842 16.895 54.0493 14.3379 57.2556 14.3379C60.4619 14.3379 63.0269 16.895 63.0269 20.0913C63.0269 23.2877 60.4619 25.8447 57.2556 25.8447Z"/>
        <path
          d="M134.574 15.4338C134.482 16.0731 135.123 16.5297 136.222 16.7123C140.162 17.2603 144.65 19.2694 144.65 24.0183C144.65 29.7717 139.154 31.6895 135.398 31.6895C132.467 31.6895 128.985 30.8676 126.329 27.3059L129.718 23.0137C131.276 24.6575 133.383 25.3881 135.032 25.4795C136.406 25.4795 137.139 25.0228 137.139 24.3836C137.139 23.8356 136.681 23.2877 135.306 23.105C131.367 22.6484 127.153 20.1826 127.153 15.5251C127.153 10.5936 131.734 8.12785 136.131 8.12785C138.055 8.12785 141.169 8.40183 143.918 11.3242L140.436 15.7078C138.696 14.4292 136.955 14.3379 136.314 14.3379C135.215 14.3379 134.574 14.8858 134.574 15.4338Z"/>
        <path
          d="M233.969 14.1553V20.7306C234.244 22.831 235.893 24.4749 238 24.7489V32.1461C231.679 31.7808 226.549 26.5753 226.549 20.1826V14.1553H223.526V8.49315H226.549V3.28767L233.969 2.55708V8.49315H237.725V14.1553H233.969Z"/>
        <path
          d="M206.761 8.6758H214.365V9.95434C215.831 9.13242 217.663 8.6758 219.495 8.6758V14.4292C217.022 14.4292 214.915 16.1644 214.365 18.5388V31.5069H206.761V8.6758Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M178.546 20.1826C178.546 13.516 183.951 8.12785 190.638 8.12785C197.326 8.12785 202.731 13.4247 202.731 20.1826C202.731 26.8493 197.326 32.2374 190.638 32.2374C183.951 32.2374 178.546 26.8493 178.546 20.1826ZM184.867 20.0913C184.867 23.2877 187.432 25.8447 190.638 25.8447C193.844 25.8447 196.41 23.2877 196.41 20.0913C196.41 16.895 193.844 14.3379 190.638 14.3379C187.432 14.3379 184.867 16.895 184.867 20.0913Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M162.331 8.12785C160.224 8.12785 158.209 8.6758 156.56 9.58904V8.6758H148.956V40H156.56V30.5936C158.3 31.5069 160.224 32.0548 162.331 32.0548C169.018 32.0548 174.423 26.6667 174.423 20C174.423 13.4247 169.018 8.12785 162.331 8.12785ZM162.331 25.8447C159.125 25.8447 156.56 23.2877 156.56 20.0913C156.56 16.895 159.125 14.3379 162.331 14.3379C165.537 14.3379 168.102 16.895 168.102 20.0913C168.102 23.2877 165.537 25.8447 162.331 25.8447Z"/>
        <path
          d="M86.3872 14.3379C87.7614 14.3379 89.0439 14.7945 90.0516 15.6164L94.5404 11.1416C92.4334 9.22374 89.5935 8.03653 86.3872 8.03653C79.6998 8.03653 74.2948 13.4247 74.2948 20.0913C74.2948 26.758 79.6998 32.1461 86.3872 32.1461C89.5019 32.1461 92.3418 30.9589 94.5404 29.0411L90.0516 24.5662C89.0439 25.3881 87.7614 25.8447 86.3872 25.8447C83.1809 25.8447 80.6159 23.2877 80.6159 20.0913C80.6159 16.895 83.1809 14.3379 86.3872 14.3379Z"/>
        <path
          d="M106.358 18.5388L116.252 8.6758H124.405L112.771 20.1826L124.13 31.5068H113.962L107.64 25.2968L106.358 26.5753V31.5068H98.9376V0H106.358V18.5388Z"/>
      </svg>
    </div>

    <svg class="slogan" viewBox="0 0 194 9" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M137.856 0.704343C139.202 0.704343 140.099 1.33043 140.173 2.66086H140.921C140.846 0.860865 139.65 0 137.931 0C136.211 0 135.09 0.86087 135.09 2.34783C135.09 3.9733 136.406 4.29732 137.665 4.6071L137.706 4.61739C139.575 5.08695 140.472 5.32175 140.472 6.49567C140.472 7.59132 139.575 8.29566 138.155 8.29566C136.585 8.29566 135.538 7.51305 135.538 5.94783H134.791V6.0261C134.791 7.90436 136.062 9 138.08 9C139.575 9 141.145 8.37393 141.145 6.49567C141.145 4.77393 139.8 4.38261 138.005 3.99131C136.66 3.67827 135.763 3.44348 135.763 2.34783C135.763 1.33043 136.585 0.704343 137.856 0.704343Z"/>
      <path
        d="M8.074 8.7652H7.25165L5.60694 2.66084C5.53218 2.34782 5.45743 2.05437 5.38269 1.76091C5.30794 1.46746 5.23315 1.17387 5.1584 0.86085C5.08364 1.13476 5.00888 1.42824 4.93412 1.72172C4.85936 2.01521 4.7846 2.30869 4.70984 2.5826L3.06513 8.68694H2.24277L0 0.0782418H0.822355L2.3923 6.02607C2.41758 6.13192 2.44286 6.23552 2.46777 6.33765C2.59024 6.83961 2.70398 7.30582 2.7661 7.82606C2.84086 7.19998 2.99038 6.65216 3.21466 6.02607L4.85934 0.0782418H5.75646L7.40117 6.18258C7.55069 6.65215 7.70021 7.3565 7.77497 7.90433C7.85831 7.59899 7.91842 7.29365 7.98119 6.97476C8.03104 6.72155 8.08259 6.45966 8.14877 6.18258L9.71869 0.0782418H10.541L8.074 8.7652Z"/>
      <path d="M18.316 8.76528H17.4937V0.156579H18.316V8.76528Z"/>
      <path
        d="M31.9222 8.7652H32.8193V0.0782418H32.0717V5.47824C32.0717 5.86954 32.0904 6.24128 32.1091 6.61302C32.1278 6.98476 32.1464 7.35649 32.1464 7.7478C31.8474 7.12171 31.4736 6.49563 31.0998 5.94781L27.2124 0.0782418H26.3152V8.68694H27.0628V3.13041C27.0628 2.42606 27.0628 1.79997 26.9881 1.09562C27.1874 1.5652 27.4532 1.96521 27.719 2.36522C27.852 2.56522 27.9849 2.76521 28.1094 2.9739L31.9222 8.7652Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M56.8917 8.7652H55.9946L55.0227 6.02607H51.2848L50.3129 8.7652H49.4906L52.8547 0.0782418H53.7519L56.8917 8.7652ZM53.1538 0.939116L51.5091 5.39997H54.7985L53.1538 0.939116Z"/>
      <path d="M65.8628 0.860922H68.7037V0.156579H62.1249V0.860922H65.0405V8.76528H65.8628V0.860922Z"/>
      <path d="M90.9819 0.860922H88.1411V8.76528H87.3187V0.860922H84.4031V0.156579H90.9819V0.860922Z"/>
      <path
        d="M103.84 8.76528H104.588V0.156579H103.84V3.91309H98.9064V0.156579H98.084V8.76528H98.9064V4.61743H103.84V8.76528Z"/>
      <path
        d="M118.269 0.860898H113.335V3.99133H117.97V4.69568H113.335V8.13915H118.344V8.84352H112.587V0.234821H118.269V0.860898Z"/>
      <path d="M154.452 0.860922H151.537V8.76528H150.789V0.860922H147.874V0.156579H154.452V0.860922Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M166.339 8.7652H167.236L164.022 0.0782418H163.124L159.76 8.7652H160.657L161.629 6.02607H165.367L166.339 8.7652ZM161.854 5.39997L163.498 0.939116L165.143 5.39997H161.854Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M178.002 0.156579C179.422 0.156579 180.543 0.860927 180.543 2.50441C180.543 3.60006 179.945 4.38265 178.899 4.61743C179.945 4.77396 180.244 5.40004 180.319 6.57396C180.319 6.96526 180.319 8.37397 180.693 8.76528H179.945C179.721 8.45223 179.721 7.27832 179.721 6.88702C179.646 5.24354 179.048 4.9305 177.553 4.9305H175.161V8.76528H174.338V0.156579H178.002ZM175.086 4.3044H177.403C178.6 4.3044 179.796 4.06963 179.796 2.58267C179.796 1.25224 178.824 0.939188 177.777 0.939188H175.086V4.3044Z"/>
      <path d="M191.159 0.860922H194V0.156579H187.421V0.860922H190.337V8.76528H191.159V0.860922Z"/>
    </svg>
  </div>
</template>

<script>
import gsap from 'gsap'

export default {
  name: 'WinterHero',
  data: () => ({
    container: null,
    gyroPresent: false,
  }),
  mounted() {
    this.container = this.$refs.hero
    window.addEventListener('resize', this.handleWindowResize)
    window.addEventListener('devicemotion', this.handleDeviceMotion)
  },
  beforeUnmount() {
    window.removeEventListener('resize', this.handleWindowResize)
    window.removeEventListener('devicemotion', this.handleDeviceMotion)
  },
  methods: {
    getRel(x, y) {
      return {
        x: (x - this.container.offsetLeft - this.container.offsetWidth / 2) / this.container.offsetWidth,
        y: (y - this.container.offsetTop - this.container.offsetHeight / 2) / this.container.offsetHeight,
      }
    },
    /** @param {MouseEvent} e */
    handleMouseMove(e) {
      if (this.gyroPresent) return // TODO Handle device motion
      const {x, y} = this.getRel(e.pageX, e.pageY)
      this.parallaxCloudLeft(x, y)
      this.parallaxCloudRight(x, y)
      this.parallaxMountains(x, y)
      this.parallaxMiddleMountains(x, y)
      this.parallaxFrontMountains(x, y)
      this.parallaxMan(x, y)
    },
    parallaxCloudLeft(x, y) {
      const cloud = this.$refs.cloudLeft
      if (window.innerWidth >= 768) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = `translateX(calc(-3% - ${x * 80}px)) translateY(calc(50vh - 135% - ${y * 20}px)) scale(${1 + y / 10})`
        } else if (x < 0 && y < 0) {
          transformValue = `translateX(calc(-3% - ${x * 60}px)) translateY(calc(50vh - 135% - ${y * 20}px)) scale(${1 + Math.abs(y / 10)})`
        } else if (x > 0 && y > 0) {
          transformValue = `translateX(calc(-3% - ${x * 80}px)) translateY(calc(50vh - 135% - ${y * 60}px)) scale(${1 - y / 10})`
        } else {
          transformValue = `translateX(calc(-3% - ${x * 5}px)) translateY(calc(50vh - 135% - ${y * 40}px)) scale(${1 - y / 10})`
        }
        this.parallaxElem(cloud, transformValue)
      }
    },
    parallaxCloudRight(x, y) {
      const cloud = this.$refs.cloudRight
      if (window.innerWidth >= 768) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = `translateX(calc(100vw - 85% - ${x * 40}px)) translateY(calc(50vh - 153%)) scale(${1 + Math.abs(y / 10)})`
        } else if (x < 0 && y < 0) {
          transformValue = `translateX(calc(100vw - 85% - ${x * 40}px)) translateY(calc(50vh - 153%)) scale(${1 + y / 10})`
        } else if (x > 0 && y > 0) {
          transformValue = `translateX(calc(100vw - 85% + ${x * 40}px)) translateY(calc(50vh - 153% - ${y * 30}px)) scale(${1 - y / 10})`
        } else {
          transformValue = `translateX(calc(100vw - 85% - ${x * 40}px)) translateY(calc(50vh - 153% - ${y * 30}px)) scale(${1 - y / 10})`
        }
        this.parallaxElem(cloud, transformValue)
      }
    },
    parallaxMountains(x, y) {
      const mountains = this.$refs.mountains
      if (window.innerWidth >= 1024) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 10}px)) translateY(calc(100vh - 100% - ${y * 20}px))`
            : `translateX(calc(50vw - 50% - ${x * 20}px)) translateY(calc(100vh - 103%)) scale(${1 + y / 15})`
        } else if (x < 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 10}px)) translateY(calc(100vh - 100% - ${y * 20}px))`
            : `translateX(calc(50vw - 50% - ${x * 20}px)) translateY(calc(100vh - 103% - ${y * 40}px)) scale(${1 + y / 10})`
        } else if (x > 0 && y > 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 10}px)) translateY(calc(100vh - 100% - ${y * 20}px))`
            : `translateX(calc(50vw - 50% - ${x * 20}px)) translateY(calc(100vh - 103% - ${y * 40}px))`
        } else {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 10}px)) translateY(calc(100vh - 100% - ${y * 20}px))`
            : `translateX(calc(50vw - 50% - ${x * 20}px)) translateY(calc(100vh - 103% - ${y * 80}px))`
        }
        this.parallaxElem(mountains, transformValue)
      }
    },
    parallaxMiddleMountains(x, y) {
      const mountains = this.$refs.middleMountains
      if (window.innerWidth >= 1024) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 30}px)) translateY(calc(100vh - 90% - ${y * 30}px))`
            : `translateX(calc(50vw - 50% - ${x * 40}px)) translateY(calc(100vh - 102%)) scale(${1 + y / 20})`
        } else if (x < 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 30}px)) translateY(calc(100vh - 90% - ${y * 30}px))`
            : `translateX(calc(50vw - 50% - ${x * 60}px)) translateY(calc(100vh - 102% - ${y * 40}px)) scale(${1 + y / 20})`
        } else if (x > 0 && y > 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 30}px)) translateY(calc(100vh - 90% - ${y * 30}px))`
            : `translateX(calc(50vw - 50% - ${x * 40}px)) translateY(calc(100vh - 102% + ${y * 20}px))`
        } else {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-1vw - ${x * 30}px)) translateY(calc(100vh - 90% - ${y * 30}px))`
            : `translateX(calc(50vw - 50% - ${x * 40}px)) translateY(calc(100vh - 102% + ${y * 20}px))`
        }
        this.parallaxElem(mountains, transformValue)
      }
    },
    parallaxFrontMountains(x, y) {
      const mountains = this.$refs.frontMountains
      if (window.innerWidth >= 1024) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-5% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 + y / 20})`
            : `translateX(calc(50vw - 75% + ${x * 20}px)) translateY(calc(100vh - 99%)) scale(${1 + Math.abs(y / 10)})`
        } else if (x < 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-5% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 + y / 20})`
            : `translateX(calc(50vw - 75% - ${x * 40}px)) translateY(calc(100vh - 99%)) scale(${1 + y / 10})`
        } else if (x > 0 && y > 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-5% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 + y / 20})`
            : `translateX(calc(50vw - 75% - ${x * 40}px)) translateY(calc(100vh - 99% + ${y * 10}px)) scale(${1 - y / 10})`
        } else {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(-5% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 + y / 20})`
            : `translateX(calc(50vw - 75% - ${x * 40}px)) translateY(calc(100vh - 99% - ${y * 10}px)) scale(${1 + y / 10})`
        }
        this.parallaxElem(mountains, transformValue)
      }
    },
    parallaxMan(x, y) {
      const man = this.$refs.man
      if (window.innerWidth >= 1024) {
        let transformValue = ''
        let maskSize = ''
        let maskPosition = ''
        if (x > 0 && y < 0) {
          transformValue = `translateX(calc(100vw - 98% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 + Math.abs(y / 10)})`
          maskSize = `calc(((2094 * ${1 + Math.abs(y / 10)}) * 100vw) / 1440) auto`
          maskPosition = `calc(100vw - (2052 * 100vw) / 1440 - ${x * 40}px - ${Math.abs(y * 105)}px) calc(100vh - (1024 * 100vw) / 1440 - ${Math.abs(y * 35)}px)`
        } else if (x < 0 && y < 0) {
          transformValue = `translateX(calc(100vw - 98% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 + y / 20})`
          maskSize = `calc(((2094 * ${1 + y / 20}) * 100vw) / 1440) auto`
          maskPosition = `calc(100vw - (2052 * 100vw) / 1440 - ${x * 40}px + ${Math.abs(y * 55)}px) calc(100vh - (1024 * 100vw) / 1440 + ${Math.abs(y * 75)}px)`
        } else if (x > 0 && y > 0) {
          transformValue = `translateX(calc(100vw - 98% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 + y / 20})`
          maskSize = `calc(((2094 * ${1 + y / 20}) * 100vw) / 1440) auto`
          maskPosition = `calc(100vw - (2052 * 100vw) / 1440 - ${x * 40}px - ${y * 55}px) calc(100vh - (1024 * 100vw) / 1440 - ${y * 75}px)`
        } else {
          transformValue = `translateX(calc(100vw - 98% - ${x * 40}px)) translateY(calc(100vh - 70% - ${y * 40}px)) scale(${1 - y / 20})`
          maskSize = `calc(((2094 * ${1 - y / 20}) * 100vw) / 1440) auto`
          maskPosition = `calc(100vw - (2052 * 100vw) / 1440 - ${x * 40}px + ${y * 55}px) calc(100vh - (1024 * 100vw) / 1440)`
        }
        this.parallaxElem(man, transformValue)
        this.parallaxMask(maskSize, maskPosition)
      }
    },
    parallaxElem(elem, transform) {
      gsap.to(elem, {transform, duration: 0.5})
    },
    parallaxMask(maskSize, maskPosition) {
      const logoMask = this.$refs.logoMask
      gsap.to(logoMask, {
        maskSize,
        maskPosition,
        duration: 0,
      })
    },
    /** @param {DeviceMotionEvent} event */
    handleDeviceMotion(event) {
      // Check whether gyroscope is present
      const {alpha, beta, gamma} = event.rotationRate
      if (alpha || beta || gamma) this.gyroPresent = true
    },
    handleWindowResize() {
      this.resetPositions()
    },
    resetPositions() {
      const {hero, ...refs} = this.$refs
      for (const ref of Object.values(refs)) {
        gsap.to(ref, {clearProps: 'all', duration: 0})
      }
    },
  },
}
</script>

<style scoped lang="scss">
@import "../../assets/scss/breakpoints";
@import "../../assets/scss/variables";

.winter-hero {
  height: 100%;
  position: relative;
  background: linear-gradient(0deg, rgba(36, 55, 70, 0.3), rgba(36, 55, 70, 0.3)), linear-gradient(164.83deg, #116296 8.41%, #FFFFFF 89.34%);

  img {
    position: absolute;
  }

  &__cloud-left {
    width: calc((399 * 100vw) / 320);
    transform: translateX(-5%) translateY(calc(50vh - 150%));

    @include tablets {
      width: calc((750 * 100vw) / 1440);
      max-width: 750px;
      transform: translateX(-3%) translateY(calc(50vh - 135%));
    }
  }

  &__cloud-right {
    width: calc((259 * 100vw) / 320);
    transform: translateX(calc(100vw - 70%)) translateY(calc(50vh - 132%));

    @include tablets {
      width: calc((410 * 100vw) / 1440);
      max-width: 410px;
      transform: translateX(calc(100vw - 85%)) translateY(calc(50vh - 153%));
    }
  }

  &__bg3 {
    width: calc((736 * 100vw) / 320);
    transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 129%));

    @include landscape {
      width: 100vw;
      transform: translateY(calc(100vh - 100%));
    }

    @include big-phones-landscape {
      width: 100vw;
      transform: translateY(calc(100vh - 100%));
    }

    @include phones-tablets {
      transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 100%));
    }

    @include laptop {
      width: calc((1966 * 100vw) / 1440);
      transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 103%));
    }

    @media screen and (min-width: 1441px) {
      width: 102vw;
      transform: translateX(-1vw) translateY(calc(100vh - 100%));
    }
  }

  &__bg2 {
    width: calc((793 * 100vw) / 320);
    transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 116%));

    @include landscape {
      width: 100vw;
      transform: translateY(calc(100vh - 75%));
    }

    @include big-phones-landscape {
      width: 100vw;
      transform: translateY(calc(100vh - 75%));
    }

    @include phones-tablets {
      transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 85%));
    }

    @include laptop {
      width: calc((1681 * 100vw) / 1440);
      transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 102%));
    }

    @media screen and (min-width: 1441px) {
      width: 102vw;
      transform: translateX(-1vw) translateY(calc(100vh - 90%));
    }
  }

  &__bg1 {
    width: calc((524 * 100vw) / 320);
    transform: translateX(calc(50vw - 75%)) translateY(calc(100vh - 110%));

    @include landscape {
      width: 100vw;
      transform: translateY(calc(100vh - 60%));
    }

    @include big-phones-landscape {
      width: 100vw;
      transform: translateY(calc(100vh - 60%));
    }

    @include phones-tablets {
      transform: translateX(calc(50vw - 75%)) translateY(calc(100vh - 100%));
    }

    @include laptop {
      width: calc((1158 * 100vw) / 1440);
      transform: translateX(calc(50vw - 75%)) translateY(calc(100vh - 99%));
    }

    @media screen and (min-width: 1441px) {
      width: 1508px;
      transform: translateX(-5%) translateY(calc(100vh - 70%));
    }
  }

  &__man {
    width: calc((822 * 100vw) / 320);
    transform: translateX(-46%) translateY(calc(100vh - 86%));

    @include landscape {
      width: 100vw;
      transform: translateX(1px) translateY(calc(100vh - 76%));
    }

    @include big-phones-landscape {
      width: 100vw;
      transform: translateX(1px) translateY(calc(100vh - 76%));
    }

    @include phones-tablets {
      transform: translateX(-46%) translateY(calc(100vh - 70%));
    }

    @include laptop {
      width: calc((2094 * 100vw) / 1440);
      max-width: 2094px;
      transform: translateX(calc(100vw - 98%)) translateY(calc(100vh - 70%));
    }
  }

  .logo-back, .logo-mask__logo {
    width: calc((256 * 100vw) / 320);
    position: absolute;
    fill: $text-accent-color;
    transform: translateX(calc(50vw - 50%)) translateY(calc(50vh - 70%));

    @include laptop {
      width: 714px;
      transform: translateX(calc(50vw - 50%)) translateY(calc(50vh - 104%));
    }
  }

  .logo-mask {
    $mask-image: url("/img/hero/winter/man.png");
    width: 100vw;
    height: 100vh;
    position: absolute;
    mask-image: $mask-image;
    mask-repeat: no-repeat;
    mask-size: calc((822 * 100vw) / 320) auto;
    mask-position: calc(75.5%) calc(100vh - (493 * 100vw) / 320);
    //background-color: rgba(grey, 0.5);

    @include landscape {
      mask-image: unset;
    }

    @include big-phones-landscape {
      mask-image: unset;
    }

    @include phones-tablets {
      mask-image: unset;
    }

    @include laptop {
      mask-image: $mask-image;
      mask-size: calc((2094 * 100vw) / 1440) auto;
      mask-position: calc(100vw - (2052 * 100vw) / 1440) calc(100vh - (1024 * 100vw) / 1440);
    }

    @include large-desktop {
      mask-size: 2094px auto;
      mask-position: calc(100vw - 2052px) calc(100vh - 1024px);
    }
  }

  .slogan {
    width: calc((212 * 100vw) / 320);
    fill: $text-accent-color;
    position: absolute;
    transform: translateX(calc(50vw - 50%)) translateY(calc(50vh + 190%));

    @include laptop {
      width: 613px;
      transform: translateX(calc(50vw - 50%)) translateY(calc(50vh + 50%));
    }
  }
}
</style>