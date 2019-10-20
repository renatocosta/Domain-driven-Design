# O que é Domain-Driven Design 
Uma nova abordagem para modelagem de software que reúne conceitos, princípios e técnicas para resolver problemas de negócio.

# Os pilares do DDD são

<ul>
<li>Domínio</li>
<li>Design estratégico e tático</li>
<li>Linguagem onipresente</li>
<li>Modelos</li>
<li>Bounded Context</li>
</ul>

# Domínio
Uma esfera de conhecimento e/ou atividades.<br>
É uma forma de representar alguma área do negócio da empresa.<br>
Tipos:<br>
<ul>
<li>Core</li>
<li>Supporting</li>
<li>Generic</li>
</ul>

# Design estratégico
<ul>
<li>É a parte mais importante do DDD</li>
<li>Extrair conhecimento</li>
</ul>

# Design tático
É um catálogo de padrões de projeto que nos ajuda a criar códigos que sejam o reflexo do nosso modelo de negócio

# Linguagem onipresente
<ul>
<li>Linguagem versátil compartilhada pela equipe</li>
<li>Unifica a divisão linguística entre os envolvidos tornando-a em uma linguagem comum</li>
<li>No cenário agtual time de negócio tem um conhecimento limitado do jargão técnico</li>
</ul>

# Modelos
<ul>
<li>São conjunto de itens que descrevem a funcionalidade do sistema</li>
<li>Descrevem aspectos do domínio assim como é utilizado para resolver um determinado problema</li>
<li>O modelo reflete a visão do domínio</li>
</ul>
Etapas para a construção:<br>
Modelagem, classificação e diagramas inter relacionados.

# Bounded Context
<ul>
<li>Desbravando as fronteiras do seu negócio</li>
<li>Delimita o seu domínio complexo em contextos baseados nas intenções do negócio</li>
<li>Estimula a criação de squads por contexto</li>
</ul>

# Building Blocks
A ligação entre o modelo e a implementação deve ser feita detalhadamente aqui<br>
Expressa o modelo do ponto de vista do software
<ul>
<li>Entity - Um objeto definido por sua identidade</li>
<li>Aggregate/Aggregate Root</li>
<li>Domain Events</li>
</ul>