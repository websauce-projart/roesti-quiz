<template>
  <div>
    <div class="speech-bubble white-bg">
      <nav>
        <div>X</div>
        <ol>
          <li><a href="home">Accueil</a></li>
          <li><a href="profile">Profil</a></li>
          <li><a href="logout">Se déconnecter</a></li>
        </ol>
      </nav>
    </div>
    <div>PRESENTATEUR ICI</div>
  </div>
</template>

<script>

export default {
  methods: {
            setTitle() {
                this.thecardtitle = 'NEW card title!'
            },
            setBody() {
                this.thecardbody = 'Now we have <b>NEW</b> text. It is STILL great text, that I can tell you.'
            }
        }
};
</script>
