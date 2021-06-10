<template>
	<dialog open class="modal mainNav">
		<nav class="container">
			<div class="topnav topnav--right">
				<button class="icon-close" aria-label="Fermer le menu"></button>
			</div>
			<ul class="mainNav__items">
				<li><a href="/home">Accueil</a></li>
				<li><a href="/profile">Profil</a></li>
			</ul>
			<a href="/logout">Se déconnecter</a>
		</nav>
	</dialog>
</template>

<script>
import { watch, ref } from "vue";

export default {
	setup(props, context) {
		const visible = (val) => {
			context.emit("update:visibility", val);
		};
		return { visible };
	},
	emits: ["update:visibility"],

	/* 	methods: {
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
	}, */
};
</script>

<style lang="postcss" scoped>
.mainNav {
	background: var(--color-background-darker);
}
.mainNav__items {
	background: white; /* need to replace with bubble speech */
	display: flex;
	justify-content: center;
	flex-direction: column;
	text-align: center;
	font-family: var(--font-headings);
	font-size: var(--fontsize-xl);
	letter-spacing: var(--fontspacing-headings);

	& a {
		text-decoration: none;
		color: var(--color-secondary);
		transition: var(--animation-hover);
	}

	& a:hover {
		color: var(--color-main);
	}
}
</style>
