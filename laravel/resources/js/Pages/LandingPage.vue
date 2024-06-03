<template>
  <div class="landing-page">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container d-flex">
        <!-- Move o botão de login para a direita e deixe ele maior -->
        <div class="ml-auto">
          <button @click="goToRoute('/login')" class="btn btn-lg btn-primary login-btn">Login</button>
        </div>
      </div>
    </nav>
 
    <!-- Header Section -->
    <header class="header text-center">
      <div class="container-fluid p-0">
        <img src="@/Pages/images/clinicaxastre.png" alt="Banner da Clínica X-Ames Xastre" class="img-fluid banner-image" />
      </div>
    </header>

    <!-- Services Section -->
    <section id="services" class="services py-5 text-center">
      <div class="container">
        <h2 class="section-title">Nossos Serviços</h2>
        <p>Oferecemos uma ampla gama de serviços médicos para atender suas necessidades.</p>
        <div class="row mt-4">
          <div class="col-md-4">
            <h4 class="keyword-highlight">Consulta Geral</h4>
            <p>Atendemos pacientes de todas as idades com consultas gerais e check-ups.</p>
          </div>
          <div class="col-md-4">
            <h4 class="keyword-highlight">Especialidades</h4>
            <p>Oferecemos consultas com especialistas em diversas áreas da medicina.</p>
          </div>
          <div class="col-md-4">
            <h4 class="keyword-highlight">Exames</h4>
            <p>Realizamos uma variedade de exames laboratoriais e de imagem.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about bg-light py-5 text-center">
      <div class="container">
        <h2 class="section-title">Sobre a Clínica</h2>
        <button @click="toggleAbout" class="btn btn-lg btn-primary action-btn mt-3">Ver Descrição</button>
        <transition name="fade">
          <div v-if="showAbout" class="mt-4">
            <div class="row">
              <div class="col-md-6">
                <p>Nossa clínica foi fundada em 2000 com o objetivo de oferecer serviços médicos de alta qualidade para toda a comunidade. Contamos com uma equipe de profissionais dedicados e experientes que estão prontos para cuidar de você e de sua família.</p>
              </div>
              <div class="col-md-6">
                <p>Com instalações modernas e equipamentos de última geração, garantimos um atendimento eficiente e confortável. Nossa missão é promover a saúde e o bem-estar de nossos pacientes, sempre com um atendimento humanizado e personalizado.</p>
              </div>
            </div>
          </div>
        </transition>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials py-5 text-center">
      <div class="container">
        <h2 class="section-title">Depoimentos de Pacientes</h2>
        <button @click="toggleTestimonials" class="btn btn-lg btn-primary action-btn mt-3">Ver Depoimentos</button>
        <transition name="fade">
          <div v-if="showTestimonials" class="mt-4">
            <div class="row">
              <div class="col-md-4">
                <blockquote class="blockquote">
                  <p class="mb-0">"Excelente atendimento e profissionais muito competentes. Recomendo a todos!"</p>
                  <footer class="blockquote-footer">Maria Silva</footer>
                </blockquote>
              </div>
              <div class="col-md-4">
                <blockquote class="blockquote">
                  <p class="mb-0">"Ambiente acolhedor e equipe médica extremamente qualificada."</p>
                  <footer class="blockquote-footer">João Pereira</footer>
                </blockquote>
              </div>
              <div class="col-md-4">
                <blockquote class="blockquote">
                  <p class="mb-0">"A clínica oferece uma excelente variedade de serviços e exames."</p>
                  <footer class="blockquote-footer">Ana Souza</footer>
                </blockquote>
              </div>
            </div>
          </div>
        </transition>
      </div>
    </section>

    <!-- Contact Button Section -->
    <section id="contact" class="contact bg-light py-5">
      <div class="container text-center">
        <h2 class="section-title">Contato</h2>
        <button @click="toggleContactForm" class="btn btn-lg btn-primary action-btn mt-3">Entrar em Contato</button>
        <transition name="fade">
          <div v-if="showContactForm" class="mt-4">
            <div class="row">
              <div class="col-md-6 mx-auto">
                <!-- Formulário de contato -->
                <form @submit.prevent="submitContactForm">
                  <div class="form-group">
                    <label for="name">Nome</label>
                    <input type="text" class="form-control" id="name" v-model="form.name" required>
                  </div>
                  <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" id="email" v-model="form.email" required>
                  </div>
                  <div class="form-group">
                    <label for="message">Mensagem</label>
                    <textarea class="form-control" id="message" rows="4" v-model="form.message" required></textarea>
                  </div>
                  <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
              </div>
            </div>
          </div>
        </transition>
      </div>
    </section>

    <!-- Contact Information Section -->
    <section id="info" class="info py-5 text-center">
      <div class="container">
        <h2 class="section-title">Informações de Contato</h2>
        <div class="row mt-4">
          <div class="col-md-4">
            <h4 class="keyword-highlight">Telefone</h4>
            <p class="field-margin">(99)99999-9999</p>
          </div>
          <div class="col-md-4">
            <h4 class="keyword-highlight">E-mail</h4>
            <p class="field-margin">xames@gmail.com</p>
          </div>
          <div class="col-md-4">
            <h4 class="keyword-highlight">Endereço</h4>
            <p class="field-margin">Rua PUC-CAMPINAS 123 - Campinas SP</p>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-md-6">
            <h4 class="keyword-highlight">Horário de Funcionamento</h4>
            <p>Segunda a Sexta: 8h - 18h</p>
            <p>Sábado: 8h - 12h</p>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        message: ''
      },
      showAbout: false,
      showTestimonials: false,
      showContactForm: false
    };
  },
  methods: {
    submitContactForm() {
      axios.post('/api/contact', this.form)
        .then(response => {
          alert('Formulário enviado com sucesso!');
          this.form.name = '';
          this.form.email = '';
          this.form.message = '';
        })
        .catch(error => {
          console.error('Erro ao enviar o formulário:', error);
          alert('Ocorreu um erro ao enviar o formulário.');
        });
    },
    goToRoute(route) {
      this.$inertia.visit(route);
    },
    toggleAbout() {
      this.showAbout = !this.showAbout;
    },
    toggleTestimonials() {
      this.showTestimonials = !this.showTestimonials;
    },
    toggleContactForm() {
      this.showContactForm = !this.showContactForm;
    }
  }
};
</script>

<style scoped>

.landing-page {
  font-family: Arial, sans-serif;
}

.header {
  background: #fcfbfb;
  color: white;
  padding: 5rem 0;
}

.header .banner-image {
  width: 100%;
  height: auto;
  max-height: 100vw; /* Ajuste o valor conforme necessário */
  object-fit: cover;
}

.services, .about, .testimonials, .contact, .info {
  padding: 3rem 0;
}

.text-center h2, .text-center p, .text-center h4 {
  margin: 0 auto;
}

.btn {
  margin-top: 1rem;
}

.text-center {
  text-align: center;
}

.bg-light {
  background-color: #f8f9fa;
}

.bg-primary {
  background-color: #1100ff;
  color: white;
}

.form-group {
  margin-bottom: 1rem;
}

.blockquote {
  border-left: 0.25rem solid hwb(241 0% 0%);
  padding-left: 1rem;
  margin-top: 1rem;
  margin-bottom: 1rem;
}

blockquote-footer {
  font-size: 0.8rem;
  color: #6c757d;
}

.navbar {
  margin-bottom: 1rem;
}

.container {
  max-width: 1200px;
}

.section-title {
  margin-bottom: 2rem;
  font-size: 2.5rem;
}

.fade-enter-active, .fade-leave-active {
  transition: opacity 0.5s;
}

.fade-enter, .fade-leave-to {
  opacity: 0;
}

/* Estilos para o formulário de contato */
.contact form {
  background-color: #f8f9fa; /* Fundo do formulário */
  padding: 2rem; /* Espaçamento interno */
  border-radius: 10px; /* Borda arredondada */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */
}

/* Estilos para o botão de login */
.login-btn {
  padding: 1rem 2rem; /* Aumenta o tamanho do botão */
  font-size: 1.25rem; /* Aumenta o tamanho do texto */
  background-color: #007bff; /* Cor de fundo personalizada */
  color: white; /* Cor do texto */
  border: none; /* Remove a borda */
  border-radius: 0.5rem; /* Borda arredondada */
  transition: background-color 0.3s ease; /* Transição suave para a cor de fundo */
}

.login-btn:hover {
  background-color: #0056b3; /* Cor de fundo ao passar o mouse */
}

/* Estilos para os botões de ação */
.action-btn {
  padding: 1rem 2rem; /* Aumenta o tamanho do botão */
  font-size: 1.25rem; /* Aumenta o tamanho do texto */
  background-color: #007bff; /* Cor de fundo personalizada */
  color: white; /* Cor do texto */
  border: none; /* Remove a borda */
  border-radius: 0.5rem; /* Borda arredondada */
  transition: background-color 0.3s ease; /* Transição suave para a cor de fundo */
}

.action-btn:hover {
  background-color: #0056b3; /* Cor de fundo ao passar o mouse */
}

/* Ajustes de layout para centralizar as seções */
.services, .about, .testimonials, .contact, .info {
  display: flex;
  flex-direction: column;
  align-items: center;
}

.container > .row {
  display: flex;
  justify-content: center;
  align-items: center;
}

.container > .row > .col-md-4, .container > .row > .col-md-6 {
  max-width: 600px;
  margin:10px;
}

.section-title {
  margin-bottom: 2rem;
  font-size: 2.5rem;
  text-align: center;
}

/* Destaque para palavras-chave */
.keyword-highlight {
  font-weight: bold;
  color: #007bff; /* Cor de destaque */
  background-color: #e9f7ff; /* Fundo de destaque */
  padding: 0.25rem 0.5rem; /* Espaçamento interno */
  border-radius: 0.25rem; /* Borda arredondada */
}

/* Melhorias de estilo adicionais */
.landing-page h2, .landing-page h4, .landing-page p {
  color: #333;
}

.landing-page .btn-primary {
  background-color: #0069d9;
  border-color: #0062cc;
}

.landing-page .btn-primary:hover {
  background-color: #0056b3;
  border-color: #004085;
}
</style>

