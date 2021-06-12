<template>
	<input type="text" v-model="searchText" />
	<ul>
		<li v-for="data in filteredList()" :key="data">
			<input
				@click="playerSelected()"
				type="radio"
				:id="`${data}`"
				name="user"
				:value="`${data}`"
			/>
			<label :for="`${data}`">{{ data }}</label>
			<avatar :dataSearch="this.findId(data)"></avatar>
		</li>
	</ul>
	<div class="" v-if="showRandomPlayer()" :key="searchText">
		<div class="">Tu n'as pas d'ami ?</div>

		<div class="btn btn--secondary" @click="this.randomPlayer()">
			Victime aléatoire
		</div>
	</div>

	<input
		v-if="this.returnValue"
		class=""
		id="submit--new--game"
		type="submit"
		value="Suivant"
	/>
</template>

<script>
import { ref } from "vue";
import avatar from "../elements/show_avatar.vue";

export default {
	props: {
		datas: Object,
	},

	components: {
		avatar,
	},

	data() {
		return {
			randomPlayerPseudo: "",
			returnValue: false,
			randomActualise: false,
		};
	},

	setup(props) {
		let searchText = ref("");

		let list = [];

		//Show or hide the button for a random player depending on the input text value
		function showRandomPlayer() {
			if (searchText.value == "") return true;
			else {
				return false;
			}
		}

		//Filter the list of User with the input box and returns an array of corresponding users
		function filteredList() {
			list = [];
			let datas = props.datas;
			if (searchText.value == "") {
				return list;
			}

			this.playerSelected;

			for (let index in datas) {
				list.push(datas[index].pseudo);
			}

			return list.filter((data) =>
				data.toLowerCase().includes(searchText.value.toLowerCase())
			);
		}

		return { searchText, filteredList, showRandomPlayer };
	},
	methods: {
		//Return a random player from the available ones, show it in the input text and selects it
		randomPlayer() {
			this.playerSelected;
			var keys = Object.keys(this.$props.datas);
			this.randomPlayerPseudo =
				this.$props.datas[keys[(keys.length * Math.random()) << 0]].pseudo;
			this.searchText = this.randomPlayerPseudo;
			this.randomActualise = true;
			return this.randomPlayerPseudo;
		},

		//Return a true value if a player is selected
		playerSelected() {
			this.returnValue = false;
			document.querySelectorAll("li").forEach((element) => {
				if (element.querySelector("input").checked) {
					this.returnValue = true;
				}
			});
		},

		findId(pseudo) {
			if (typeof pseudo == "string") {
				return this.$props.datas.find((e) => e.pseudo == pseudo).id;
			}
		},
	},
	updated() {
		this.findId(this.$props.datas);
		//after datas and DOM are updated
		this.$nextTick(function () {
			//Hide the submit button if searchText is empty
			if (this.searchText == "") {
				this.returnValue = false;
				this.randomPlayerPseudo = "";
			}

			//Checks the randomPlayer input radio
			if (this.randomPlayerPseudo != "" && this.randomActualise) {
				document.getElementById(this.randomPlayerPseudo).checked = true;
				this.randomActualise = false;
				this.returnValue = true;
			}
		});
	},
};
</script>
