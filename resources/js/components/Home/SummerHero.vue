<template>
  <div @mousemove="handleMouseMove" ref="hero" class="summer-hero">
    <img src="/img/hero/summer/cloud-3.png" class="cloud-3" alt="Cloud" ref="cloud3">
    <img src="/img/hero/summer/cloud-2.png" class="cloud-2" alt="Cloud" ref="cloud2">
    <img src="/img/hero/summer/cloud-1.png" class="cloud-1" alt="Cloud" ref="cloud1">

    <svg class="logo-back" viewBox="0 0 288 49" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M45.5612 25.1712V0H36.582V24.6119C36.582 32.4429 42.679 38.9315 50.4388 39.2671V30.2055C47.8891 29.8699 45.7829 27.8562 45.5612 25.1712Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M9.20092 11.7466C11.3072 10.6279 13.6351 9.95662 16.1848 9.95662C24.2771 9.95662 30.8176 16.4452 30.8176 24.6119C30.8176 32.7785 24.2771 39.379 16.1848 39.379C13.6351 39.379 11.3072 38.7078 9.20092 37.589V38.7078H0V0.111872H9.20092V11.7466ZM9.20092 24.6119C9.20092 28.5274 12.3049 31.6598 16.1848 31.6598C20.0647 31.6598 23.1686 28.5274 23.1686 24.6119C23.1686 20.6963 20.0647 17.5639 16.1848 17.5639C12.3049 17.5639 9.20092 20.6963 9.20092 24.6119Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M76.2679 11.7466C74.1617 10.6279 71.8337 9.95662 69.2841 9.95662C61.1917 9.95662 54.6513 16.5571 54.6513 24.7237C54.6513 32.8904 61.1917 39.4909 69.2841 39.4909C71.8337 39.4909 74.1617 38.8196 76.2679 37.7009V38.8196H84.582V10.8516H76.2679V11.7466ZM69.2841 31.6598C65.4042 31.6598 62.3002 28.5274 62.3002 24.6119C62.3002 20.6963 65.4042 17.5639 69.2841 17.5639C73.164 17.5639 76.2679 20.6963 76.2679 24.6119C76.2679 28.5274 73.164 31.6598 69.2841 31.6598Z"/>
      <path
        d="M162.845 18.9064C162.734 19.6895 163.51 20.2489 164.841 20.4726C169.607 21.1438 175.039 23.605 175.039 29.4224C175.039 36.4703 168.388 38.8196 163.843 38.8196C160.296 38.8196 156.083 37.8128 152.868 33.4498L156.97 28.1918C158.855 30.2055 161.404 31.1005 163.4 31.2123C165.062 31.2123 165.949 30.653 165.949 29.8699C165.949 29.1986 165.395 28.5274 163.732 28.3037C158.965 27.7443 153.866 24.7237 153.866 19.0183C153.866 12.9772 159.409 9.95662 164.73 9.95662C167.058 9.95662 170.827 10.2922 174.152 13.8721L169.94 19.242C167.834 17.6758 165.727 17.5639 164.952 17.5639C163.621 17.5639 162.845 18.2352 162.845 18.9064Z"/>
      <path
        d="M283.122 17.3402V25.395C283.455 27.968 285.45 29.9817 288 30.3174V39.379C280.351 38.9315 274.143 32.5548 274.143 24.7237V17.3402H270.485V10.4041H274.143V4.0274L283.122 3.13242V10.4041H287.667V17.3402H283.122Z"/>
      <path
        d="M250.199 10.6279H259.4V12.1941C261.173 11.1872 263.39 10.6279 265.607 10.6279V17.6758C262.614 17.6758 260.065 19.8014 259.4 22.71V38.5959H250.199V10.6279Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M216.055 24.7237C216.055 16.5571 222.596 9.95662 230.688 9.95662C238.781 9.95662 245.321 16.4452 245.321 24.7237C245.321 32.8904 238.781 39.4909 230.688 39.4909C222.596 39.4909 216.055 32.8904 216.055 24.7237ZM223.704 24.6119C223.704 28.5274 226.808 31.6598 230.688 31.6598C234.568 31.6598 237.672 28.5274 237.672 24.6119C237.672 20.6963 234.568 17.5639 230.688 17.5639C226.808 17.5639 223.704 20.6963 223.704 24.6119Z"/>
      <path fill-rule="evenodd" clip-rule="evenodd"
            d="M196.434 9.95662C193.885 9.95662 191.446 10.6279 189.45 11.7466V10.6279H180.249V49H189.45V37.4772C191.557 38.5959 193.885 39.2671 196.434 39.2671C204.527 39.2671 211.067 32.6667 211.067 24.5C211.067 16.4452 204.527 9.95662 196.434 9.95662ZM196.434 31.6598C192.554 31.6598 189.45 28.5274 189.45 24.6119C189.45 20.6963 192.554 17.5639 196.434 17.5639C200.314 17.5639 203.418 20.6963 203.418 24.6119C203.418 28.5274 200.314 31.6598 196.434 31.6598Z"/>
      <path
        d="M104.536 17.5639C106.199 17.5639 107.751 18.1233 108.97 19.1301L114.402 13.6484C111.852 11.2991 108.416 9.84475 104.536 9.84475C96.4434 9.84475 89.903 16.4452 89.903 24.6119C89.903 32.7785 96.4434 39.379 104.536 39.379C108.305 39.379 111.741 37.9247 114.402 35.5753L108.97 30.0936C107.751 31.1005 106.199 31.6598 104.536 31.6598C100.656 31.6598 97.552 28.5274 97.552 24.6119C97.552 20.6963 100.656 17.5639 104.536 17.5639Z"/>
      <path
        d="M128.702 22.71L140.674 10.6279H150.54L136.462 24.7237L150.208 38.5959H137.903L130.254 30.9886L128.702 32.5548V38.5959H119.723V0H128.702V22.71Z"/>
    </svg>

    <img src="/img/hero/summer/city.png" class="city" alt="City" ref="city" />
    <img src="/img/hero/summer/skatepark-3.png" class="skatepark-3" alt="Skatepark" ref="skatepark3" />
    <img src="/img/hero/summer/skatepark-2.png" class="skatepark-2" alt="Skatepark" ref="skatepark2" />
    <img src="/img/hero/summer/skatepark-1.png" class="skatepark-1" alt="Skatepark" ref="skatepark1" />
    <img src="/img/hero/summer/man.png" class="man" alt="Man" ref="man" />
    <img src="/img/hero/summer/skateboard.png" class="skateboard" alt="Skateboard" ref="skate" />

    <div class="logo-mask">
      <svg class="logo-mask__logo" viewBox="0 0 288 49" xmlns="http://www.w3.org/2000/svg">
        <path
          class="logo-mask__logo--hidden"
          d="M45.5612 25.1712V0H36.582V24.6119C36.582 32.4429 42.679 38.9315 50.4388 39.2671V30.2055C47.8891 29.8699 45.7829 27.8562 45.5612 25.1712Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" class="logo-mask__logo--hidden"
              d="M9.20092 11.7466C11.3072 10.6279 13.6351 9.95662 16.1848 9.95662C24.2771 9.95662 30.8176 16.4452 30.8176 24.6119C30.8176 32.7785 24.2771 39.379 16.1848 39.379C13.6351 39.379 11.3072 38.7078 9.20092 37.589V38.7078H0V0.111872H9.20092V11.7466ZM9.20092 24.6119C9.20092 28.5274 12.3049 31.6598 16.1848 31.6598C20.0647 31.6598 23.1686 28.5274 23.1686 24.6119C23.1686 20.6963 20.0647 17.5639 16.1848 17.5639C12.3049 17.5639 9.20092 20.6963 9.20092 24.6119Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd" class="logo-mask__logo--hidden"
              d="M76.2679 11.7466C74.1617 10.6279 71.8337 9.95662 69.2841 9.95662C61.1917 9.95662 54.6513 16.5571 54.6513 24.7237C54.6513 32.8904 61.1917 39.4909 69.2841 39.4909C71.8337 39.4909 74.1617 38.8196 76.2679 37.7009V38.8196H84.582V10.8516H76.2679V11.7466ZM69.2841 31.6598C65.4042 31.6598 62.3002 28.5274 62.3002 24.6119C62.3002 20.6963 65.4042 17.5639 69.2841 17.5639C73.164 17.5639 76.2679 20.6963 76.2679 24.6119C76.2679 28.5274 73.164 31.6598 69.2841 31.6598Z"/>
        <path
          d="M162.845 18.9064C162.734 19.6895 163.51 20.2489 164.841 20.4726C169.607 21.1438 175.039 23.605 175.039 29.4224C175.039 36.4703 168.388 38.8196 163.843 38.8196C160.296 38.8196 156.083 37.8128 152.868 33.4498L156.97 28.1918C158.855 30.2055 161.404 31.1005 163.4 31.2123C165.062 31.2123 165.949 30.653 165.949 29.8699C165.949 29.1986 165.395 28.5274 163.732 28.3037C158.965 27.7443 153.866 24.7237 153.866 19.0183C153.866 12.9772 159.409 9.95662 164.73 9.95662C167.058 9.95662 170.827 10.2922 174.152 13.8721L169.94 19.242C167.834 17.6758 165.727 17.5639 164.952 17.5639C163.621 17.5639 162.845 18.2352 162.845 18.9064Z"/>
        <path
          class="logo-mask__logo--hidden"
          d="M283.122 17.3402V25.395C283.455 27.968 285.45 29.9817 288 30.3174V39.379C280.351 38.9315 274.143 32.5548 274.143 24.7237V17.3402H270.485V10.4041H274.143V4.0274L283.122 3.13242V10.4041H287.667V17.3402H283.122Z"/>
        <path
          d="M250.199 10.6279H259.4V12.1941C261.173 11.1872 263.39 10.6279 265.607 10.6279V17.6758C262.614 17.6758 260.065 19.8014 259.4 22.71V38.5959H250.199V10.6279Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M216.055 24.7237C216.055 16.5571 222.596 9.95662 230.688 9.95662C238.781 9.95662 245.321 16.4452 245.321 24.7237C245.321 32.8904 238.781 39.4909 230.688 39.4909C222.596 39.4909 216.055 32.8904 216.055 24.7237ZM223.704 24.6119C223.704 28.5274 226.808 31.6598 230.688 31.6598C234.568 31.6598 237.672 28.5274 237.672 24.6119C237.672 20.6963 234.568 17.5639 230.688 17.5639C226.808 17.5639 223.704 20.6963 223.704 24.6119Z"/>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M196.434 9.95662C193.885 9.95662 191.446 10.6279 189.45 11.7466V10.6279H180.249V49H189.45V37.4772C191.557 38.5959 193.885 39.2671 196.434 39.2671C204.527 39.2671 211.067 32.6667 211.067 24.5C211.067 16.4452 204.527 9.95662 196.434 9.95662ZM196.434 31.6598C192.554 31.6598 189.45 28.5274 189.45 24.6119C189.45 20.6963 192.554 17.5639 196.434 17.5639C200.314 17.5639 203.418 20.6963 203.418 24.6119C203.418 28.5274 200.314 31.6598 196.434 31.6598Z"/>
        <path
          class="logo-mask__logo--hidden"
          d="M104.536 17.5639C106.199 17.5639 107.751 18.1233 108.97 19.1301L114.402 13.6484C111.852 11.2991 108.416 9.84475 104.536 9.84475C96.4434 9.84475 89.903 16.4452 89.903 24.6119C89.903 32.7785 96.4434 39.379 104.536 39.379C108.305 39.379 111.741 37.9247 114.402 35.5753L108.97 30.0936C107.751 31.1005 106.199 31.6598 104.536 31.6598C100.656 31.6598 97.552 28.5274 97.552 24.6119C97.552 20.6963 100.656 17.5639 104.536 17.5639Z"/>
        <path
          class="logo-mask__logo--hidden"
          d="M128.702 22.71L140.674 10.6279H150.54L136.462 24.7237L150.208 38.5959H137.903L130.254 30.9886L128.702 32.5548V38.5959H119.723V0H128.702V22.71Z"/>
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
import {scaleValue} from '../../helpers'

export default {
  name: 'SummerHero',
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
    /** @param {MouseEvent} e */
    handleMouseMove(e) {
      if (this.gyroPresent) return // TODO Handle device motion
      const {x, y} = this.getRel(e.pageX, e.pageY)
      this.parallaxMan(x, y)
      this.parallaxSkate(x, y)
      this.parallaxCloud3(x, y)
      this.parallaxCloud2(x, y)
      this.parallaxCloud1(x, y)
      this.parallaxCity(x, y)
      this.parallaxSkatepark3(x, y)
      this.parallaxSkatepark2(x, y)
      this.parallaxSkatepark1(x, y)
    },
    getRel(x, y) {
      return {
        x: (x - this.container.offsetLeft - this.container.offsetWidth / 2) / this.container.offsetWidth,
        y: (y - this.container.offsetTop - this.container.offsetHeight / 2) / this.container.offsetHeight,
      }
    },
    parallaxMan(x, y) {
      const man = this.$refs.man
      if (window.innerWidth >= 1024) {
        this.parallaxElem(man, `translateX(calc(50vw + 9% + ${x * 40}px)) translateY(calc(50vh - 60% + ${y * 40}px))`)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(man, `translateX(calc(50vw - 23% + ${x * 20}px)) translateY(calc(50vh - 56% + ${y * 20}px)) rotate(-15deg)`)
      }
    },
    // Skate parallax
    parallaxSkate(x, y) {
      const skate = this.$refs.skate
      if (window.innerWidth >= 1024) {
        this.parallaxElem(skate, `translateX(calc(50vw - 94% + ${x * 40}px)) translateY(calc(50vh + 6% + ${y * 40}px))`)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(skate, `translateX(calc(50vw - 142% + ${x * 20}px)) translateY(calc(50vh + 47% + ${y * 20}px)) rotate(-15deg)`)
      }
    },
    // Cloud 3 parallax
    parallaxCloud3(x, y) {
      const cloud = this.$refs.cloud3
      if (window.innerWidth >= 1024) {
        this.parallaxElem(cloud, `translateX(calc(50vw - 192% - ${x * 16}px)) translateY(calc(9vh - ${y * 16}px))`)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(cloud, `translateX(calc(50vw - 90% - ${x * 8}px)) translateY(calc(12vh - ${y * 8}px))`)
      }
    },
    parallaxCloud2(x, y) {
      const cloud = this.$refs.cloud2
      if (window.innerWidth >= 1024) {
        this.parallaxElem(cloud, `translateX(calc(50vw - 10% - ${x * 24}px)) translateY(calc(6vh - ${y * 24}px))`)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(cloud, `translateX(calc(50vw - 9% - ${x * 20}px)) translateY(calc(18vh - ${y * 20}px))`)
      }
    },
    parallaxCloud1(x, y) {
      const cloud = this.$refs.cloud1
      if (window.innerWidth >= 1024) {
        this.parallaxElem(cloud, `translateX(calc(50vw - 128% - ${x * 15}px)) translateY(calc(22vh - ${y * 15}px))`)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(cloud, `translateX(calc(-30vw - ${x * 15}px)) translateY(calc(25vh - ${y * 15}px))`)
      }
    },
    parallaxCity(x, y) {
      const city = this.$refs.city
      if (window.innerWidth > 1440) {
        if (y > 0) {
          this.parallaxElem(city, `translateX(${-x * 10}px) translateY(calc(100vh - 87%)) scale(${1 + Math.abs(y / 20)})`)
        } else {
          this.parallaxElem(city, `translateX(${-x * 10}px) translateY(calc(100vh - 87%))`)
        }
      } else if (window.innerWidth >= 1024 && window.innerWidth <= 1440) {
        if (y < 0) {
          this.parallaxElem(city, `translateX(calc(50vw - 55% - ${x * 30}px)) translateY(calc(100vh - 87% - ${y * 30}px))`)
        } else {
          this.parallaxElem(city, `translateX(calc(50vw - 55% - ${x * 30}px)) translateY(calc(100vh - 87% - ${y * 30}px)) scale(${1 + Math.abs(y / 10)})`)
        }
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        if (y > 0) {
          this.parallaxElem(city, `translateX(calc(50vw - 50% - ${x * 10}px)) translateY(calc(100vh - 90%)) scale(${1 + Math.abs(y / 10)})`)
        } else {
          this.parallaxElem(city, `translateX(calc(50vw - 50% - ${x * 10}px)) translateY(calc(100vh - 90%))`)
        }
      }
    },
    parallaxSkatepark3(x, y) {
      const skatepark = this.$refs.skatepark3
      if (window.innerWidth >= 1024) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(100vw - 100%)) translateY(calc(100vh - 50%)) rotate(-${scaleValue(Math.abs(y), [0, 1], [0, 2])}deg)`
            : `translateX(calc(100vw - 100%)) translateY(calc(100vh - 60%)) rotate(-${scaleValue(Math.abs(y), [0, 1], [0, 2])}deg)`
        } else if (x < 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(100vw - 100% - ${x * 32}px)) translateY(calc(100vh - 50% - ${y * 32}px))`
            : `translateX(calc(100vw - 100% - ${x * 32}px)) translateY(calc(100vh - 60% - ${y * 32}px))`
        } else if (x > 0 && y > 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(100vw - 100%)) translateY(calc(100vh - 50% - ${y * 20}px)) scale(${1 + Math.abs(y / 10)})`
            : `translateX(calc(100vw - 100%)) translateY(calc(100vh - 60% - ${y * 20}px)) scale(${1 + Math.abs(y / 10)})`
        } else {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(100vw - 100%)) translateY(calc(100vh - 50% - ${y * 32}px))`
            : `translateX(calc(100vw - 100%)) translateY(calc(100vh - 60% + ${y * 32}px))`
        }
        this.parallaxElem(skatepark, transformValue)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(skatepark, `translateX(calc(50vw - 40% - ${x * 15}px)) translateY(calc(100vh - 106% - ${y * 15}px))`)
      }
    },
    parallaxSkatepark2(x, y) {
      const skatepark = this.$refs.skatepark2
      if (window.innerWidth >= 1024) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(50vw - 50% - ${x * 20}px)) translateY(calc(100vh - 45% - ${y * 20}px))`
            : `translateX(calc(50vw - 63% - ${x * 20}px)) translateY(calc(100vh - 50% - ${y * 20}px))`
        } else if (x < 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(50vw - 50% - ${x * 20}px)) translateY(calc(100vh - 45% + ${y * 20}px))`
            : `translateX(calc(50vw - 63% - ${x * 20}px)) translateY(calc(100vh - 50% + ${y * 20}px))`
        } else if (x > 0 && y > 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(50vw - 50% + ${x * 20}px)) translateY(calc(100vh - 45% - ${y * 20}px))`
            : `translateX(calc(50vw - 63% + ${x * 20}px)) translateY(calc(100vh - 50% - ${y * 20}px))`
        } else {
          transformValue = window.innerWidth > 1440
            ? `translateX(calc(50vw - 50%)) translateY(calc(100vh - 45% - ${y * 20}px)) scale(${1 + Math.abs(y / 10)})`
            : `translateX(calc(50vw - 63%)) translateY(calc(100vh - 50% - ${y * 20}px)) scale(${1 + Math.abs(y / 10)})`
        }
        this.parallaxElem(skatepark, transformValue)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(skatepark, `translateX(calc(50vw - 67% - ${x * 25}px)) translateY(calc(100vh - 70% - ${y * 25}px))`)
      }
    },
    parallaxSkatepark1(x, y) {
      const skatepark = this.$refs.skatepark1
      if (window.innerWidth >= 1024) {
        let transformValue = ''
        if (x > 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(${-y * 10}px) translateY(calc(100vh - 50% + ${y * 20}px)) scale(${1 + Math.abs(y / 20)})`
            : `translateX(${-y * 20}px) translateY(calc(100vh - 47% + ${y * 20}px)) scale(${1 + Math.abs(y / 20)})`
        } else if (x < 0 && y < 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(${y * 40}px) translateY(calc(100vh - 50% - ${y * 20}px)) scale(${1 - Math.abs(y / 10)})`
            : `translateX(${y * 60}px) translateY(calc(100vh - 47% - ${y * 20}px)) scale(${1 - Math.abs(y / 10)})`
        } else if (x > 0 && y > 0) {
          transformValue = window.innerWidth > 1440
            ? `translateX(${-y * 40}px) translateY(calc(100vh - 50% - ${y * 20}px)) scale(${1 - Math.abs(y / 10)})`
            : `translateX(${-y * 60}px) translateY(calc(100vh - 47% - ${y * 20}px)) scale(${1 - Math.abs(y / 10)})`
        } else {
          transformValue = window.innerWidth > 1440
            ? `translateX(${y * 40}px) translateY(calc(100vh - 50% - ${y * 20}px)) scale(${1 + Math.abs(y / 10)})`
            : `translateX(${y * 60}px) translateY(calc(100vh - 47% - ${y * 20}px)) scale(${1 + Math.abs(y / 10)})`
        }
        this.parallaxElem(skatepark, transformValue)
      } else if (window.innerWidth >= 768 && window.innerWidth < 1024) {
        this.parallaxElem(skatepark, `translateX(calc(50vw - 50% - ${x * 30}px)) translateY(calc(100vh - 55% - ${y * 30}px))`)
      }
    },
    parallaxElem(elem, transform) {
      gsap.to(elem, {transform})
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
@import "../../assets/scss/variables";
@import "../../assets/scss/breakpoints";

.summer-hero {
  height: 100vh;
}

img {
  position: absolute;
}

.cloud-1 {
  width: ((235 * 100vw) / 320);
  max-width: 563px;
  transform: translateX(-30vw) translateY(25vh);

  @include landscape {
    width: 40vw;
    transform: translateX(25vw) translateY(30vh);
  }

  @include laptop {
    transform: translateX(calc(50vw - 128%)) translateY(22vh);
  }
}

.cloud-2 {
  width: calc((275 * 100vw) / 320);
  max-width: 658px;
  transform: translateX(calc(50vw - 9%)) translateY(18vh);

  @include landscape {
    width: 30vw;
    transform: translateX(calc(50vw + 50%)) translateY(15vh);
  }

  @include laptop {
    transform: translateX(calc(50vw - 10%)) translateY(6vh);
  }
}

.cloud-3 {
  width: calc((157 * 100vw) / 320);
  max-width: 375px;
  transform: translateX(calc(50vw - 90%)) translateY(12vh);

  @include landscape {
    width: 30vw;
    transform: translateX(calc(50vw - 150%)) translateY(13vh);
  }

  @include laptop {
    transform: translateX(calc(50vw - 192%)) translateY(9vh);
  }
}

.city {
  width: calc((872 * 100vw) / 320);
  transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 103%));

  @include landscape {
    width: 100vw;
  }

  @include big-phones-landscape {
    width: 100vw;
  }

  @include phones-tablets {
    transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 90%));
  }

  @include laptop {
    width: calc((2010 * 100vw) / 1440);
    transform: translateX(calc(50vw - 55%)) translateY(calc(100vh - 87%));
  }

  @media screen and (min-width: 1441px) {
    width: 100vw;
    transform: translateX(0) translateY(calc(100vh - 87%));
  }
}

.skatepark-1 {
  width: calc((477 * 100vw) / 320);
  transform: translateX(-31%) translateY(calc(100vh - 72%));

  @include landscape {
    width: 60vw;
    transform: translateX(0) translateY(calc(100vh - 60%));
  }

  @include big-phones-landscape {
    width: 60vw;
    transform: translateX(0) translateY(calc(100vh - 60%));
  }

  @include phones-tablets {
    transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 55%));
  }

  @include laptop {
    width: calc((1219 * 100vw) / 1440);
    transform: translateX(0) translateY(calc(100vh - 47%));
  }

  @media screen and (min-width: 1441px) {
    width: 50vw;
    transform: translateX(0) translateY(calc(100vh - 50%));
  }
}

.skatepark-2 {
  width: calc((801 * 100vw) / 320);
  transform: translateX(calc(50vw - 67%)) translateY(calc(100vh - 70%));

  @include landscape {
    width: 100vw;
    transform: translateX(0) translateY(calc(100vh - 65%));
  }

  @include big-phones-landscape {
    width: 100vw;
    transform: translateX(0) translateY(calc(100vh - 65%));
  }

  @include laptop {
    width: calc((2048 * 100vw) / 1440);
    transform: translateX(calc(50vw - 63%)) translateY(calc(100vh - 50%));
  }

  @media screen and (min-width: 1441px) {
    width: 114vw;
    transform: translateX(calc(50vw - 50%)) translateY(calc(100vh - 45%));
  }
}

.skatepark-3 {
  width: calc((410 * 100vw) / 320);
  transform: translateX(calc(50vw - 40%)) translateY(calc(100vh - 106%));

  @include landscape {
    width: 50vw;
    transform: translateX(calc(100vw - 100%)) translateY(calc(100vh - 94%));
  }

  @include big-phones-landscape {
    width: 50vw;
    transform: translateX(calc(100vw - 100%)) translateY(calc(100vh - 94%));
  }

  @include laptop {
    width: calc((1048 * 100vw) / 1440);
    transform: translateX(calc(100vw - 100%)) translateY(calc(100vh - 60%));
  }

  @media screen and (min-width: 1441px) {
    width: 50vw;
    transform: translateX(calc(100vw - 100%)) translateY(calc(100vh - 50%));
  }
}

.man {
  max-width: 477px;
  width: calc((242 * 100vw) / 320);
  transform: translateX(calc(50vw - 23%)) translateY(calc(50vh - 56%)) rotate(-15deg);

  @include landscape {
    width: 35vw;
    transform: translateX(calc(50vw)) translateY(calc(50vh - 50%)) rotate(-15deg);
  }

  @include big-phones-landscape {
    width: 35vw;
    transform: translateX(calc(50vw)) translateY(calc(50vh - 50%)) rotate(-15deg);
  }

  @include laptop {
    width: 477px;
    transform: translateX(calc(50vw + 9%)) translateY(calc(50vh - 60%));
  }
}

.skateboard {
  max-width: 170px;
  width: calc((86 * 100vw) / 320);
  transform: translateX(calc(50vw - 142%)) translateY(calc(50vh + 47%)) rotate(-15deg);

  @include landscape {
    width: 10vw;
    transform: translateX(calc(50vw - 142%)) translateY(calc(50vh + 40%)) rotate(-15deg);
  }

  @include big-phones-landscape {
    width: 10vw;
    transform: translateX(calc(50vw - 142%)) translateY(calc(50vh + 40%)) rotate(-15deg);
  }

  @include laptop {
    width: 170px;
    transform: translateX(calc(50vw - 94%)) translateY(calc(50vh + 6%));
  }
}

.logo-back, .logo-mask__logo {
  width: calc((288 * 100vw) / 320);
  transform: translateX(calc(50vw - 50%)) translateY(calc(50vh - 110%));
  fill: $text-accent-color;
  position: absolute;

  @include big-phones-landscape {
    width: 80vw;
    transform: translateX(calc(50vw - 50%)) translateY(calc(50vh - 90%));
  }

  @include laptop {
    width: 970px;
    transform: translateX(calc(50vw - 50%)) translateY(calc(50vh - 94%));
  }
}

.logo-back {
  @include landscape {
    display: none;
  }

  @include phones-tablets {
    display: initial;
  }
}

.logo-mask {
  $mask-mobile: url("/img/hero/summer/man-mask.png");
  $mask-desktop: url("/img/hero/summer/man.png");
  width: 100vw;
  height: 100vh;
  position: absolute;
  mask-image: $mask-mobile;
  mask-repeat: no-repeat;
  mask-size: calc((314.38 * 100vw) / 320) auto;
  mask-position: 20.9vw calc(50vh - (200 * 100vw) / 320);

  @include landscape {
    mask-image: unset;
  }

  @include big-phones-landscape {
    mask-image: unset;
  }

  @include phones-tablets {
    mask-image: unset;

    &__logo {
      &--hidden {
        display: none;
      }
    }
  }
}

.slogan {
  width: calc((194 * 100vw) / 320);
  transform: translateX(calc(50vw - 50%)) translateY(calc(50vh - 10%));
  fill: $text-accent-color;
  position: absolute;

  @include big-phones-landscape {
    width: 50vw;
    transform: translateX(calc(50vw - 50%)) translateY(calc(50vh + 100%));
  }

  @include laptop {
    width: 654px;
    transform: translateX(calc(50vw - 50%)) translateY(calc(50vh + 95%));
  }
}
</style>
