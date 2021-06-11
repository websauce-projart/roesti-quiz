<template>
	<a
		class="gameBadge"
		:href="'game/' + data.game.id + '/join'"
		:class="data.game.active_user_id !== data.user.id && 'gameBadge--wait'"
	>
		<div class="gameBadge__avatar">
			<div class="avatar__container">
				<img
					src="/img/avatar/assets_avatar_background.svg"
					class="avatar__element"
				/>
				<img v-if="loaded" :src="this.pose" class="avatar__element" />
				<img v-if="loaded" :src="this.eye" class="avatar__element" />
				<img v-if="loaded" :src="this.mouth" class="avatar__element" />
			</div>
		</div>
		<div class="gameBadge__info">
			<div class="gameBadge__info__pseudo">{{ data.opponent.pseudo }}</div>
			<div
				class="gameBadge__info__statut"
				v-if="data.game.active_user_id == data.user.id"
			>
				À toi de jouer
			</div>
			<div class="gameBadge__info__statut" v-else>
				N'a pas encore relevé ton défi...
			</div>
		</div>

		<div
			class="gameBadge__play icon-arrow-right"
			v-if="data.game.active_user_id == data.user.id"
		></div>
	</a>
</template>

<script>
export default {
	data() {
		return {
			avatarData: Object,
			urlApi: "/api/avatar/",
			urlImg: "/img/avatar/",
			pose: String,
			eye: String,
			mouth: String,
			loaded: false,
		};
	},
	props: {
		data: Object,
	},
	mounted: async function () {
		await this.fetchData();
		this.concatUrl();
		this.loaded = true;
	},
	methods: {
		fetchData() {
			let user = this.$props.data.opponent.id;
			return axios
				.get(this.urlApi + user)
				.then((response) => {
					this.avatarData = response.data;
				})
				.catch((errors) => console.log(errors));
		},
		concatUrl() {
			this.pose =
				this.urlImg +
				"poses/assets_avatar_pose" +
				this.avatarData.pose +
				".svg";
			this.eye =
				this.urlImg +
				"eyes/assets_avatar_yeux" +
				this.avatarData.eye +
				".svg";
			this.mouth =
				this.urlImg +
				"mouths/assets_avatar_bouche" +
				this.avatarData.mouth +
				".svg";
		},
	},
};
</script>

<style></style>
