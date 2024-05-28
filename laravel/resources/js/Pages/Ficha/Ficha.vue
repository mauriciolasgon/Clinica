<template>
  <div class="container">
    <h1 class="title">Ficha Técnica de Atendimento</h1>
    <form id="fichaTecnicaForm" @submit.prevent="enviarFormulario">
      <div class="form-group">
        <label for="nome">Nome do Paciente</label>
        <input type="text" id="nome" name="nome" :placeholder="ficha.paciente_name" v-model="ficha.paciente_name" class="form-control">
      </div>
      <div class="form-group">
        <label for="formas de contato">Formas de Contato</label>
        <div class="contact-info">
          <div>
            <label>E-mail</label>
            <input :placeholder="ficha.email" readonly v-model="ficha.email" class="form-control">
          </div>
          <div>
            <label>Telefone</label>
            <input :placeholder="ficha.numero_cel" v-model="ficha.numero_cel" class="form-control">
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="genero">Gênero</label>
        <select id="genero" name="genero" v-model="ficha.genero" class="form-control">
          <option :value="ficha.genero">{{ficha.genero}}</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
          <option value="Outro">Outro</option>
        </select>
      </div>
      <div class="form-group">
        <label for="endereco">Endereço</label>
        <input id="logradouro" name="logradouro" :placeholder="endereco.logradouro" readonly class="form-control">
        <input id="localidade" name="localidade" :placeholder="endereco.localidade" readonly class="form-control">
        <input id="uf" name="uf" :placeholder="endereco.uf" readonly class="form-control">
      </div>
      <div class="form-group">
        <label for="dataAtendimento">Data do Atendimento</label>
        <input id="dataAtendimento" name="dataAtendimento" :placeholder="ficha.data_atendimento" v-model="ficha.data_atendimento" class="form-control">
      </div>
      <div class="form-group">
        <label for="queixaPrincipal">Queixa Principal</label>
        <textarea id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="ficha.queixa" v-model="ficha.queixa" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="atestados">Atestados</label>
        <textarea id="atestados" name="atestados" rows="4"  :placeholder="ficha.atestados" v-model="ficha.atestados" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="diagnostico">Diagnóstico</label>
        <textarea id="diagnostico" name="diagnostico" rows="4" :placeholder="ficha.diagnostico" v-model="ficha.diagnostico" class="form-control"></textarea>
      </div>
      <div class="form-group">
        <label for="encaminhamentos">Encaminhamentos</label>
        <textarea id="encaminhamentos" name="encaminhamentos" rows="4" v-model="ficha.encaminhamentos" :placeholder="ficha.encaminhamentos" class="form-control"></textarea>
      </div>
      <div class="form-actions">
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="reset" class="btn btn-secondary">Resetar</button>
        <button type="button" class="btn btn-info" @click="gerarPDF">Gerar PDF</button>
      </div>
    </form>
  </div>
</template>

<script setup>
import jsPDF from 'jspdf';
import { useForm, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';

const { props } = usePage();
const ficha = props.agendamento.ficha;
const endereco = ref([]);

const fetchAddress = async () => {
    if (props.agendamento.paciente.cep.length === 8) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${props.agendamento.paciente.cep}/json/`);
            const data = await response.json();
            if (!data.erro) {
                endereco.value = data;
            } else {
                console.log('CEP não encontrado');
            }
        } catch (error) {
            console.error('Erro ao buscar endereço:', error);
        }
    }
};
onMounted(() => {
    fetchAddress();
});

const enviarFormulario = async () => {
    try {
        const dadosFormulario = {
            id: ficha.id,
            paciente_id: props.agendamento.paciente.id,
            paciente_name: ficha.paciente_name,
            email: props.agendamento.paciente.email,
            numero_cel: ficha.numero_cel,
            genero: ficha.genero,
            cep: props.agendamento.paciente.cep,
            data_atendimento: props.agendamento.data,
            queixa: ficha.queixa,
            atestados: ficha.atestados,
            diagnostico: ficha.diagnostico,
            encaminhamentos: ficha.encaminhamentos
        };
        await axios.post('/attFicha', dadosFormulario);
        alert('Ficha atualizada com sucesso!');
    } catch (error) {
        console.error('Erro ao atualizar ficha:', error);
        alert('Erro ao atualizar ficha. Verifique o console para mais detalhes.');
    }
};

// Função para gerar o PDF
const gerarPDF = () => {
    const doc = new jsPDF();

    // Adicionar conteúdo dos campos ao PDF
    const atestadosContent = ficha.atestados;
    const diagnosticoContent = ficha.diagnostico;
    const encaminhamentosContent = ficha.encaminhamentos;

    // Adicionar conteúdo ao PDF
    doc.text("Atestados:", 10, 10);
    doc.text(atestadosContent, 10, 20);
    doc.text("Diagnóstico:", 10, 40);
    doc.text(diagnosticoContent, 10, 50);
    doc.text("Encaminhamentos:", 10, 70);
    doc.text(encaminhamentosContent, 10, 80);

    // Salvar o PDF
    doc.save('ficha_tecnica.pdf');
};
</script>

<style>
.container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border-radius: 8px;
  background-color: #f7f7f7;
  box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
}

.title {
  text-align: center;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 20px;
}

label {
  font-weight: bold;
}

.form-control {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

.contact-info {
  display: flex;
  justify-content: space-between;
}

.form-actions {
  text-align: center;
  margin-top: 20px;
}

.btn {
  padding: 10px 20px;
  margin-right: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.btn-primary {
  background-color: #007bff;
  color: #fff;
}

.btn-secondary {
  background-color: #6c757d;
  color: #fff;
}

.btn-info {
  background-color: #17a2b8;
  color: #fff;
}

.btn:hover {
  opacity: 0.8;
}
</style>
