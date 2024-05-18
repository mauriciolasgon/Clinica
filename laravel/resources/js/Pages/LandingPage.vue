<!-- resources/js/Pages/LandingPage.vue -->

<template>
    <div class="landing-page">
      <!-- Navigation Bar -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
          <a class="navbar-brand" href="#">Clínica Saúde Total</a>
          <div class="ml-auto">
            <button @click="goToRoute('/login')" class="btn btn-secondary">Login</button>
          </div>
        </div>
      </nav>
  
      <!-- Header Section -->
      <header class="header text-center bg-primary text-white py-5">
        <h1 class="display-4">Bem-vindo à Clínica Saúde Total</h1>
        <p class="lead">Cuidados médicos de qualidade para toda a família.</p>
        <a href="#services" class="btn btn-light mt-3">Saiba mais</a>
      </header>
  
      <!-- Services Section -->
      <section id="services" class="services py-5">
        <div class="container">
          <h2 class="text-center">Nossos Serviços</h2>
          <p class="text-center">Oferecemos uma ampla gama de serviços médicos para atender suas necessidades.</p>
          <div class="row mt-4">
            <div class="col-md-4">
              <h4>Consulta Geral</h4>
              <p>Atendemos pacientes de todas as idades com consultas gerais e check-ups.</p>
            </div>
            <div class="col-md-4">
              <h4>Especialidades</h4>
              <p>Oferecemos consultas com especialistas em diversas áreas da medicina.</p>
            </div>
            <div class="col-md-4">
              <h4>Exames</h4>
              <p>Realizamos uma variedade de exames laboratoriais e de imagem.</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- About Section -->
      <section id="about" class="about bg-light py-5">
        <div class="container">
          <h2 class="text-center">Sobre a Clínica</h2>
          <p class="text-center">A Clínica Saúde Total está comprometida com a excelência em cuidados de saúde.</p>
          <div class="row mt-4">
            <div class="col-md-6">
              <p>Nossa clínica foi fundada em 2000 com o objetivo de oferecer serviços médicos de alta qualidade para toda a comunidade. Contamos com uma equipe de profissionais dedicados e experientes que estão prontos para cuidar de você e de sua família.</p>
            </div>
            <div class="col-md-6">
              <p>Com instalações modernas e equipamentos de última geração, garantimos um atendimento eficiente e confortável. Nossa missão é promover a saúde e o bem-estar de nossos pacientes, sempre com um atendimento humanizado e personalizado.</p>
            </div>
          </div>
        </div>
      </section>
  
      <!-- Testimonials Section -->
      <section id="testimonials" class="testimonials py-5">
        <div class="container">
          <h2 class="text-center">Depoimentos de Pacientes</h2>
          <div class="row mt-4">
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
      </section>
  
      <!-- Contact Form Section -->
      <section id="contact" class="contact bg-light py-5">
        <div class="container">
          <h2 class="text-center">Contato</h2>
          <form @submit.prevent="submitContactForm" class="mt-4">
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
            <button @click="goToRoute('/testroute')" type="button" class="btn btn-secondary ml-2">Test Route</button>
          </form>
        </div>
      </section>
  
      <!-- Contact Information Section -->
      <section id="info" class="info py-5">
        <div class="container">
          <h2 class="text-center">Informações de Contato</h2>
          <div class="row mt-4">
            <div class="col-md-4">
              <h4>Telefone</h4>
              <p>(11) 1234-5678</p>
            </div>
            <div class="col-md-4">
              <h4>E-mail</h4>
              <p>contato@clinicasaude.com</p>
            </div>
            <div class="col-md-4">
              <h4>Endereço</h4>
              <p>Rua da Saúde, 123, São Paulo, SP</p>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-md-6">
              <h4>Horário de Funcionamento</h4>
              <p>Segunda a Sexta: 8h - 18h</p>
              <p>Sábado: 8h - 12h</p>
            </div>
            <div class="col-md-6">
              <button @click="goToRoute('/testroute')" class="btn btn-primary">Acessar Test Route</button>
            </div>
          </div>
        </div>
      </section>
  

    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          message: ''
        }
      };
    },
    methods: {
      submitContactForm() {
        // Enviar o formulário de contato (este é um exemplo, adapte conforme necessário)
        console.log('Formulário enviado:', this.form);
      },
      goToRoute(route) {
        this.$inertia.visit(route);
      }
    }
  };
  </script>
  
  <style scoped>
  .landing-page {
    font-family: Arial, sans-serif;
  }
  
  .header {
    background: #007bff;
    color: white;
    padding: 5rem 0;
  }
  
  .services, .about, .testimonials, .contact, .info, .login {
    padding: 3rem 0;
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
    background-color: #007bff;
    color: white;
  }
  
  .form-group {
    margin-bottom: 1rem;
  }
  
  .blockquote {
    border-left: 0.25rem solid #007bff;
    padding-left: 1rem;
    margin-top: 2rem;
  }
  
  .navbar {
    padding: 1rem 0;
  }
  
  .navbar-brand {
    font-size: 1.5rem;
  }
  
  .navbar .ml-auto .btn {
    margin: 0;
  }
  </style>
  