<template>
	<div id="cardscontainer">
		<GameCardsStack
			:cards="visibleCards"
			:qid="qid"
			@cardAccepted="handleCardAccepted"
			@cardRejected="handleCardRejected"
			@cardSkipped="handleCardSkipped"
			@hideCard="removeCardFromDeck"
		/>
	</div>
</template>

<script>
import GameCardsStack from "./components/GameCardsStack";

export default {
	name: "CardsApp",
	components: {
		GameCardsStack,
	},

	data() {
		return {
			visibleCards: [],
			qid: Array,
		};
	},

	props: {
		datas: Object,
	},

	methods: {
		handleCardAccepted() {
			// console.log(this.qid[0]);
			document.getElementById(this.qid[0]).checked = true;
		},
		handleCardRejected() {
			console.log("handleCardRejected");
		},
		handleCardSkipped() {
			console.log("handleCardSkipped");
		},
		removeCardFromDeck() {
			this.visibleCards.shift();
			this.qid.shift();
			let test = [];
			if (this.qid.length === test.length) {
				document.getElementById("quizForm").submit();
			}
		},

		createQuestionsArray() {
			let datas = this.$props.datas;
			let labels = [];
			let ids = [];

			for (let index in datas) {
				labels.push(datas[index].label);
				ids.push(datas[index].id);
			}

			this.visibleCards = labels;
			this.qid = ids;
		},
	},

	created() {
		this.createQuestionsArray();
	},
};
</script>

<style>
#cardscontainer {
	text-align: center;
}

.card {
	box-shadow: var(--boxshadow-card);
	transition: 0.3s;
	border-radius: 5px; /* 5px rounded corners */
	background: var(--color-white);
	border-radius: var(--borderradius-m);
	padding: var(--margin-l);
	display: flex;
	height: 30rem;
	width: 20rem;
	justify-content: center;
	align-items: center;
	position: absolute;
	margin-top: 3rem;
}

@media (max-width: 575.98px) {
	.cards {
		display: flex;
		justify-content: center;
	}
	.card {
		padding: var(--margin-m);
		width: 17rem;
		height: 22rem;
	}
	.cardTitle {
		font-size: var(--fontsize-l);
	}
}

.cardTitle {
	font-family: var(--font-text);
	font-size: var(--fontsize-ll);
	font-weight: 300;
}

.card,
.card * {
	-ms-touch-action: none;
	touch-action: none;
}

.isCurrent {
	margin-top: 1rem;
}

.a0 {
	z-index: 10;
}

.a1 {
	z-index: 9;
	margin-top: 2rem;
}

.a2 {
	z-index: 8;
}

.a3 {
	z-index: 7;
}

.a4 {
	z-index: 6;
}

.a5 {
	z-index: 5;
}

.a6 {
	z-index: 4;
}

.a7 {
	z-index: 3;
}

.a8 {
	z-index: 2;
}

.a9 {
	z-index: 1;
}
</style>
