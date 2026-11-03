### Desafio 3 (15d_desafio3): Perfil de Usuário com Banco de Dados

Crie um sistema de login onde o usuário deverá informar seu **usuário e senha cadastrados no banco de dados**.

O sistema deverá consultar a tabela `usuarios` do banco `exercicio`, criada no exercício anterior.

O usuário também deverá escolher uma cor de fundo para sua página de perfil.

Você precisará de 3 arquivos:

1. **15d_login.php (Página de Login):**
   * Crie um formulário com os campos **Usuário**, **Senha** e **Cor de Fundo**.
   * Consulte a tabela `usuarios` para verificar se o usuário e a senha existem.
   * Se o login estiver correto, salve o usuário e a cor escolhida em variáveis de sessão.
   * Redirecione para `15d_perfil.php`.
   * Caso o usuário ou a senha estejam incorretos, exiba uma mensagem de erro.

2. **15d_perfil.php (Página de Perfil):**
   * Verifique se o usuário está logado.
   * Caso não esteja, redirecione para `15d_login.php`.
   * Exiba uma mensagem de boas-vindas com o nome do usuário.
   * Altere a cor de fundo da página de acordo com a cor escolhida no login.
   * Crie um link para sair do sistema.

3. **15d_logout.php (Página de Saída):**
   * Destrua a sessão.
   * Redirecione o usuário para `15d_login.php`.

**Banco:** `exercicio`  
**Tabela:** `usuarios`

O usuário deverá ter sido cadastrado anteriormente no exercício de cadastro de usuários.
