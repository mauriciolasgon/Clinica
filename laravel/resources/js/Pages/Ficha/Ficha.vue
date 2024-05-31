
<script setup>
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
import { ref, onMounted } from 'vue';
import axios from 'axios';

const { props } = usePage();
console.log(props.auth.user.role);
const paciente = props.agendamento.paciente;
const dados_consulta = props.agendamento;
const ficha = props.agendamento.ficha;
const endereco = ref([]);
let chegada = props.agendamento.chegada;

const fetchAddress = async () => {
  if (paciente.cep.length === 8) {
    try {
      const response = await fetch(`https://viacep.com.br/ws/${paciente.cep}/json/`);
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

const Finaliza = async () => {
  chegada = 2;
  const scheduleId = props.agendamento.id;
  try {
    await axios.post(`schedule/update/${scheduleId}`, { chegada });
    window.location.href = '/dashboard'; 
  } catch (error) {
    console.error('Erro ao finalizar sessão:', error);
  }
};

const enviarFormulario = async () => {
  try {
    const dadosFormulario = {
      id: ficha.id,
      paciente_id: paciente.id,
      paciente_name: ficha.paciente_name,
      email: paciente.email,
      numero_cel: ficha.numero_cel,
      genero: ficha.genero,
      cep: paciente.cep,
      data_atendimento: dados_consulta.data,
      queixa: ficha.queixa,
      atestado: ficha.atestado,
      diagnostico: ficha.diagnostico,
      encaminhamentos: ficha.encaminhamentos,
    };

    // Envie os dados do formulário para o backend
    await axios.post('/attFicha', dadosFormulario);
    // Exibir uma mensagem de sucesso para o usuário, redirecionar ou fazer qualquer outra ação necessária
    alert('Ficha atualizada com sucesso!');
  } catch (error) {
    // Lidar com erros, se houver
    console.error('Erro ao atualizar ficha:', error);
    alert('Erro ao atualizar ficha. Verifique o console para mais detalhes.');
  }
};

const generateAtestadoPdf = async () => {
  try {
    const response = await axios.post('/generate-atestado-pdf', { atestado: ficha.atestado }, {
      responseType: 'blob'
    });
    const pdfBlob = new Blob([response.data], { type: 'application/pdf' });
    const pdfUrl = URL.createObjectURL(pdfBlob);
    window.open(pdfUrl, '_blank');
  } catch (error) {
    console.error('Erro ao gerar PDF de Atestados:', error);
    alert('Erro ao gerar PDF de Atestados. Verifique o console para mais detalhes.');
  }
};

const generateEncaminhamentosPdf = async () => {
  try {
    const response = await axios.post('/generate-encaminhamento-pdf', { encaminhamentos: ficha.encaminhamentos }, {
      responseType: 'blob'
    });
    const pdfBlob = new Blob([response.data], { type: 'application/pdf' });
    const pdfUrl = URL.createObjectURL(pdfBlob);
    window.open(pdfUrl, '_blank');
  } catch (error) {
    console.error('Erro ao gerar PDF de Diagnóstico:', error);
    alert('Erro ao gerar PDF de Diagnóstico. Verifique o console para mais detalhes.');
  }
};
</script>

<template>
  <div class="container">
    <a :href="route('dashboard')" class="btn-back">Voltar</a>
    <h1>Ficha de Atendimento Psicológico</h1>
    <form id="fichaTecnicaForm" @submit.prevent="enviarFormulario">
      <div class="form-group">
        <label for="nome">Nome do Paciente</label>
        <input type="text" id="nome" name="nome" :placeholder="ficha.paciente_name" v-model="ficha.paciente_name">
      </div>
      <div class="form-group">
        <label for="formas de contato">Formas de Contato</label>
        <div>
          <label>E-mail:</label>
          <input :placeholder="ficha.email" readonly v-model="ficha.email">
        </div>
        <div>
          <label>Telefone:</label>
          <input :placeholder="ficha.numero_cel" v-model="ficha.numero_cel">
        </div>
      </div>
      <div class="form-group">
        <label for="genero">Gênero</label>
        <select id="genero" name="genero" v-model="ficha.genero">
          <option :value="ficha.genero">{{ficha.genero}}</option>
          <option value="Masculino">Masculino</option>
          <option value="Feminino">Feminino</option>
          <option value="outro">Outro</option>
        </select>
      </div>
      <div class="form-group">
        <label for="endereco">Endereço</label>
        <input id="logradouro" name="logradouro" :placeholder="endereco.logradouro" readonly>
        <label for="cidade">Cidade</label>
        <input id="localidade" name="localidade" :placeholder="endereco.localidade" readonly>
        <label for="estado">Estado</label>
        <input id="uf" name="uf" :placeholder="endereco.uf" readonly>
      </div>
      <div class="form-group">
        <label for="dataAtendimento">Data do Atendimento</label>
        <input id="dataAtendimento" name="dataAtendimento" :placeholder="ficha.data_atendimento" v-model="ficha.data_atendimento" readonly>
      </div>
      <div class="form-group" v-if="props.auth.user.role !== 1">
        <label for="queixaPrincipal">Queixa Principal</label>
        <textarea id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="ficha.queixa" v-model="ficha.queixa"></textarea>
      </div>  
      <div class="form-group" v-if="props.auth.user.role !== 1">
        <label for="atestado">Atestado</label>
        <textarea id="atestado" name="atestado" rows="4" :placeholder="ficha.atestado" v-model="ficha.atestado"></textarea>
        <button type="button" @click="generateAtestadoPdf" class="pdf-button">Gerar PDF de Atestado</button>
      </div>
      <div class="form-group" v-if="props.auth.user.role !== 1">
        <label for="diagnostico">Diagnóstico</label>
        <textarea id="diagnostico" name="diagnostico" rows="4" :placeholder="ficha.diagnostico" v-model="ficha.diagnostico"></textarea>
      </div>
      <div class="form-group" v-if="props.auth.user.role !== 1">
        <label for="encaminhamentos">Encaminhamentos</label>
        <textarea id="encaminhamentos" name="encaminhamentos" rows="4" v-model="ficha.encaminhamentos" :placeholder="ficha.encaminhamentos"></textarea>
        <button type="button" @click="generateEncaminhamentosPdf" class="pdf-button">Gerar PDF de Encaminhamentos</button>
      </div>
      <div class="form-actions">
        <button  v-if="props.auth.user.role !== 1" type="submit" class="save-button">Salvar</button>
        <button type="reset" class="reset-button">Resetar</button>
        <div v-if="dados_consulta.chegada !== '2' && props.auth.user.role !== 1">
          <button type="button" class="finalizar-button" @click="Finaliza">Finalizar sessão</button>
        </div>
      </div>
    </form>
  </div>
</template>

<style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    border: 1px solid #ccc;
    padding: 20px;
    border-radius: 5px;
    background-color: #f2f2f2;
}

h1 {
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    font-weight: bold;
}

.form-group input,
.form-group textarea,
.form-group select {
    width: calc(100% - 16px);
    padding: 8px;
    margin-top: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.form-group textarea {
    resize: vertical;
}

.form-actions {
    text-align: center;
}

.form-actions button {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin: 0 10px;
}

.save-button {
    background-color: #28a745;
    color: #fff;
}

.reset-button {
    background-color: #dc3545;
    color: #fff;
}

.finalizar-button {
    background-color: #007bff;
    color: #fff;
}

.pdf-button {
    padding: 8px 15px;
    font-size: 14px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-left: 10px;
    background-color: #17a2b8;
    color: #fff;
}

.btn-back {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}

.btn-back:hover {
    background-color: #0056b3;
}
</style>
