<template>
	<button class="icon-menu" @click="toggleMenu"></button>
</template>

<script>
export default {
	methods: {
		toggleMenu() {
			let menuButton = document.querySelector("#menu-button");
			let menu = document.querySelector("#menu");
			menu.classList.toggle("show-menu");
			menuButton.classList.toggle("close");
		},
		setBody() {
			this.thecardbody =
				"Now we have <b>NEW</b> text. It is STILL great text, that I can tell you.";
		},
	},
};
</script>

<style scoped>
/* .menu--button {
  width: 100 px;
  height: 30 px;
  position: absolute;
  top: 10 px;
  left: 1 px;
  z-index: 1;
  content:'≡';
  color: black;
}

#menu {
  position: absolute;
  top: 10 px;
  left: 101 px;
  z-index: 0;
}

.menuOff {
  display: none;
}

.menuOn {
  display: block;
}

.header--image {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
  z-index: 0;
} */
.page {
	font-family: sans-serif;
	max-width: 480px;
	margin: 0 auto;
	background: #000;
	color: #fff;
	line-height: 1.5;
	position: relative;
}

.header {
	padding: 0 12px;
	position: flex;
	z-index: 999;
	width: 100%;
	box-sizing: border-box;
}

ul,
li {
	display: block;
}
li {
	height: 100px;
	line-height: 50px;
	padding: 0 12px;
	border-bottom: 1px solid #777;
	background: #111;
}

#menu-button {
	position: absolute;
	top: 10%;
	left: 0;
	width: 50px;
	height: 50px;
	overflow: hidden;
	color: red;
	line-height: 50px;
	text-align: center;
	font-size: 60px;
	cursor: pointer;
	transition: all 0.5s;
	z-index: 999;
}

#menu-button::after {
	content: "×";
}
#menu-button.close {
	color: #003769;
}
#menu-button.close::after {
	content: "≡";
}

#menu {
	transition: transform 0.5s;
	position: absolute;
	width: 100%;

	transform: translateY(-300px);
}
#menu.show-menu {
	transform: translateY(90px);
}

.main {
	padding: 62px 12px 12px 12px;
}
</style>
