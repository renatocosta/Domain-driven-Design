# O que é Domain-Driven Design 
Uma abordagem para modelagem de software que reúne conceitos, princípios e técnicas para resolver problemas de negócio.

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
<li>Extrair conhecimentos</li>
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

# Relacionamento entre os domínios
### Shared Kernel<br>
Um contexto compartilhado entre outros contextos, o shared kernel é um tipo de contexto onde N bounded contexts dependem dele, uma espécie de Core, este tipo de contexto não pode ser alterado sem consultar todos os times de desenvolvimento que dependem dele.<br>
### Customer/Supplier<br>
Contextos customer dependem de contextos supplier.<br>
A equipe downstream atua como cliente (customer) da equipe upstream (supplier). As equipes definem testes de aceitação automatizados que validam as interfaces que a equipe upstream fornecem. A equipe upstream pode então fazer alterações em seu código sem medo de quebrar alguma coisa da equipe downstream.<br>
### Conformist<br>
É o cenário onde as equipes downstream e upstream não estão mutuamente alinhadas e a equipe downstream precisa atender o negócio com o que a equipe upstream fornece mesmo não estando de acordo com as necessidades. A equipe downstream precisa aceitar este fato, se conformar com isto.<br>
### Partner<br>
Neste cenário duas equipes possuem dependências mútuas em seus contextos e precisam somar esforços de modelagem para se atenderem mutuamente.<br>
### Anti Corruption Layer<br>
Neste cenário a equipe downstream desenvolve uma camada adicional anti-corrupção para se comunicar com o contexto upstream, é o cenário típico onde o supplier é um sistema legado ou uma API mal desenvolvida.<br>


# Exemplo real baseado no Bills decomposto<br>
[domains](domains)
