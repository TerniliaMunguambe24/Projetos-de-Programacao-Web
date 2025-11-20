<?php
$mensagem_enviada = false;
$dados = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $conn = new mysqli("localhost", "root", "002NzK24;", "vet");
    
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }
    
    $dados['nome_tutor'] = htmlspecialchars($_POST['nome_tutor']);
    $dados['telefone'] = htmlspecialchars($_POST['telefone']);
    $dados['email'] = htmlspecialchars($_POST['email']);
    $dados['nome_animal'] = htmlspecialchars($_POST['nome_animal']);
    $dados['especie'] = htmlspecialchars($_POST['especie']);
    $dados['motivo'] = $_POST['motivo'] === 'Outro' ? htmlspecialchars($_POST['motivo_outro']) : $_POST['motivo'];
    $dados['data'] = $_POST['data'];
    $dados['hora'] = $_POST['hora'];
    $dados['obs'] = htmlspecialchars($_POST['obs']);
    
    $stmt = $conn->prepare("INSERT INTO consultas (nome_tutor, telefone, email, nome_animal, especie, motivo, data_consulta, hora_consulta, obs) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssss", $dados['nome_tutor'], $dados['telefone'], $dados['email'], $dados['nome_animal'], $dados['especie'], $dados['motivo'], $dados['data'], $dados['hora'], $dados['obs']);
    
    if ($stmt->execute()) {
        $mensagem_enviada = true;
    }
    
    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marcar Consulta</title>
    <link rel="stylesheet" href="vet.css">
</head>
<body>
    <div id="resposta"></div>

    <main id="form-container">
        <h1>Formulário de Marcação de Consulta</h1>

        <?php if($mensagem_enviada): ?>
            <div style="background: #d4edda; padding: 10px; border-radius:5px; margin-bottom:15px;">
                <h2> Consulta marcada com sucesso!</h2>
                <p><strong>Nome do Tutor:</strong> <?= $dados['nome_tutor'] ?></p>
                <p><strong>Telefone:</strong> <?= $dados['telefone'] ?></p>
                <p><strong>Email:</strong> <?= $dados['email'] ?></p>
                <p><strong>Nome do Pet:</strong> <?= $dados['nome_animal'] ?></p>
                <p><strong>Espécie:</strong> <?= $dados['especie'] ?></p>
                <p><strong>Motivo:</strong> <?= $dados['motivo'] ?></p>
                <p><strong>Data:</strong> <?= $dados['data'] ?></p>
                <p><strong>Hora:</strong> <?= $dados['hora'] ?></p>
                <p><strong>Observações:</strong> <?= $dados['obs'] ?></p>
                <p style="margin-top: 15px; color: #28a745; font-weight: bold;"> Aguarde, você será redirecionado para o WhatsApp em 2 segundo...</p>
            </div>

            <script>
                const whatsappNumber = "258874941515";
                const message = `Olá! Quero marcar uma consulta:

📋 *Dados do Tutor:*
Nome: <?= $dados ['nome_tutor'] ?>  
Telefone: <?= $dados ['telefone'] ?>
Email: <?= $dados ['email'] ?>

🐾 *Dados do Pet:*
Nome: <?= $dados ['nome_animal'] ?>
Espécie: <?= $dados ['especie'] ?>

📅 *Detalhes da Consulta:*
Motivo: <?= $dados ['motivo'] ?>
Data: <?= $dados ['data'] ?>
Hora: <?= $dados ['hora'] ?>

📝 *Observações:*
<?= $dados ['obs'] ?: 'Nenhuma' ?>`;

                setTimeout(() => {
                    window.open(`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(message)}`, "_blank");
                }, 2000);
            </script>
        <?php endif; ?>

        <form id="consulta-form" method="POST" action="consulta.php">
           
            <h2>1. Dados do Tutor</h2>
            <label>Nome completo</label>
            <input type="text" name="nome_tutor" required>
            <label>Telefone / WhatsApp</label>
            <input type="text" name="telefone" placeholder="+258 8XX XXX XXX" required>
            <label>E-mail</label>
            <input type="email" name="email" required>
            <label>Endereço (opcional)</label>
            <input type="text" name="endereco">

            <h2>2. Dados do Animal</h2>
            <label>Nome do animal</label>
            <input type="text" name="nome_animal" required>
            <label>Espécie</label>
            <select name="especie" required>
                <option value="">Selecione</option>
                <option>Cão</option>
                <option>Gato</option>
                <option>Coelho</option>
                <option>Pássaro</option>
                <option>Outro</option>
            </select>
            <label>Raça</label>
            <input type="text" name="raca" required>
            <label>Idade</label>
            <input type="text" name="idade" required>
            <label>Sexo</label>
            <select name="sexo" required>
                <option>Macho</option>
                <option>Fêmea</option>
            </select>
            <label>Peso (aproximado)</label>
            <input type="text" name="peso" required>
            <label>É esterilizado/castrado?</label>
            <select name="castrado" required>
                <option>Sim</option>
                <option>Não</option>
            </select>

            <h2>3. Motivo da Consulta</h2>
            <label>Selecione o tipo de atendimento</label>
            <select name="motivo" id="motivo" required>
                <option>Consulta de rotina</option>
                <option>Vacinação</option>
                <option>Desparasitação</option>
                <option>Banho e tosa</option>
                <option>Check-up</option>
                <option>Cirurgia (prévia marcação)</option>
                <option>Emergência</option>
                <option>Outro</option>
            </select>
            <label id="motivo-outro-label" style="display:none;">Se escolheu "Outro", descreva aqui:</label>
            <textarea name="motivo_outro" id="motivo-outro" rows="3" style="display:none;"></textarea>

            <h2>4. Histórico de Saúde</h2>
            <label>Doenças anteriores</label>
            <textarea name="doencas" rows="2"></textarea>
            <label>Medicamentos atuais</label>
            <textarea name="medicamentos" rows="2"></textarea>
            <label>Alergias conhecidas</label>
            <textarea name="alergias" rows="2"></textarea>
            <label>Vacinas atualizadas?</label>
            <select name="vacinas" required>
                <option>Sim</option>
                <option>Não</option>
            </select>

            <h2>5. Preferência de Data e Hora</h2>
            <label>Data desejada</label>
            <input type="date" name="data" required>
            <label>Hora desejada</label>
            <input type="time" name="hora" required>
            <label>Horário alternativo (opcional)</label>
            <input type="time" name="hora_alt">

            <h2>6. Tipo de Atendimento</h2>
            <select name="tipo_atendimento" required>
                <option>Na clínica</option>
                <option>No domicílio (taxa extra)</option>
            </select>

            <h2>7. Observações adicionais</h2>
            <textarea name="obs" rows="4"></textarea>

            <h2>8. Termos e Consentimentos</h2>
            <label><input type="checkbox" name="consent_contact" required> Concordo em ser contactado pela clínica.</label>
            <label><input type="checkbox" name="consent_policies" required> Aceito as políticas da clínica.</label>
            <label><input type="checkbox" name="consent_data" required> Autorizo o atendimento e a recolha dos meus dados (LGPD).</label>

            <button type="submit" class="btn-default">Enviar Pedido</button>
        </form>

        <script>
            const motivoSelect = document.getElementById('motivo');
            const motivoOutro = document.getElementById('motivo-outro');
            const motivoOutroLabel = document.getElementById('motivo-outro-label');

            motivoSelect.addEventListener('change', () => {
                if (motivoSelect.value === 'Outro') {
                    motivoOutro.style.display = 'block';
                    motivoOutroLabel.style.display = 'block';
                    motivoOutro.required = true;
                } else {
                    motivoOutro.style.display = 'none';
                    motivoOutroLabel.style.display = 'none';
                    motivoOutro.required = false;
                }
            });
        </script>
    </main>
</body>
</html>