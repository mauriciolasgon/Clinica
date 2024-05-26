<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm,usePage } from '@inertiajs/vue3';
import Pacientes from './Pacientes.vue';
import { ref, onMounted } from 'vue';

const {props}=usePage();
const paciente =props.agendamento.paciente;
const dados_consulta=props.agendamento;

const ficha =props.agendamento.ficha;


const endereco =ref([]);




const fetchAddress = async () => {
    if (paciente.cep.length === 8) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${paciente.cep}/json/`);
            const data = await response.json();
            if (!data.erro) {
                endereco.value=data;
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
            id:ficha.id,
            paciente:paciente.name,
            email:paciente.email,
            numero_cel:ficha.numero_cel,
            genero: ficha.genero,
            cep: paciente.cep,
            data_atendimento: dados_consulta.data,
            queixa:ficha.queixa,
            atestados:ficha.atestados,
            diagnostico:ficha.diagnostico,
            encaminhamentos:ficha.encaminhamentos
                 
        };
        // Envie os dados do formulário para o backend
        await axios.post('/attFicha', {
            params: { dadosFormulario: dadosFormulario }
        });;

        // Exibir uma mensagem de sucesso para o usuário, redirecionar ou fazer qualquer outra ação necessária
        alert('Ficha atualizada com sucesso!');
      } catch (error) {
        // Lidar com erros, se houver
        console.error('Erro ao atualizar ficha:', error);
        alert('Erro ao atualizar ficha. Verifique o console para mais detalhes.');
      }
};
</script>

<template>
<div class="container">
    <h1>Ficha Técnica de Atendimento</h1>
    <form id="fichaTecnicaForm" @submit.prevent="enviarFormulario">
        <div class="form-group">
            <label for="nome">Nome do Paciente</label>
            <input type="text" id="nome" name="nome" :placeholder="paciente.name" readonly :value="paciente.name">
        </div>
        <div class="form-group">
            <label for="formas de contato">Formas de contato</label>
            <div>
                <label>E-mail</label>
                <input :placeholder="paciente.email" readonly :value="paciente.email">
            </div>
            <div>
                <label>Telefone</label>
                <input :placeholder="paciente.numero_cel" readonly :value="ficha.numero_cel">
            </div>
        </div>
        <div class="form-group">
            <label for="genero">Gênero</label>
            <select id="genero" name="genero" :value="ficha.genero" >
                <option value="">Selecione</option>
                <option value="masculino">Masculino</option>
                <option value="feminino">Feminino</option>
                <option value="outro">Outro</option>
            </select>
        </div>
        <div class="form-group">
            <label for="queixaPrincipal">Endereço</label>
            <input id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="endereco.logradouro" readonly>
            <label for="queixaPrincipal">Cidade</label>
            <input id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="endereco.localidade" readonly>
            <label for="queixaPrincipal">Estado</label>
            <input id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="endereco.uf" readonly>
        </div>
        <div class="form-group">
            <label for="dataAtendimento">Data do Atendimento</label>
            <input id="dataAtendimento" name="dataAtendimento"  :placeholder="dados_consulta.data" readonly>
        </div>
        <div class="form-group" v-if="paciente.role!==1">
            <label for="queixaPrincipal">Queixa Principal</label>
            <textarea id="queixaPrincipal" name="queixaPrincipal" rows="4" :placeholder="ficha.queixa"  :value="ficha.queixa"></textarea>
        </div>
        <div class="form-group">
            <label for="historicoClinico">Atestados</label>
            <textarea id="historicoClinico" name="historicoClinico" rows="4" :placeholder="ficha.atestados"  :value="ficha.atestados"></textarea>
        </div>
        <div class="form-group">
            <label for="diagnostico">Diagnóstico</label>
            <textarea id="diagnostico" name="diagnostico" rows="4" :placeholder="ficha.diagnostico"  :value="ficha.diagnostico"></textarea>
        </div>
        <div class="form-group">
            <label for="tratamento">Encaminhamentos</label>
            <textarea id="tratamento" name="encaminhamentos" rows="4" :placeholder="ficha.encaminhamentos" :value="ficha.encaminhamentos"></textarea>
        </div>
        <div class="form-actions">
            <button type="submit" class="save">Salvar</button>
            <button type="reset" class="reset">Resetar</button>
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
    background-color: #f9f9f9;
}
h1, h2 {
    text-align: center;
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
    width: 100%;
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
}
.form-actions .save {
    background-color: #28a745;
    color: #fff;
}
.form-actions .reset {
    background-color: #dc3545;
    color: #fff;
}
</style>
