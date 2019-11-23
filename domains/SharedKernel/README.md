
SharedKernel é um 


layer é a camada responsável por lidar com dados oriundos de parceiros externos como código legado, micro serviços e entre outros.
O principal objetivo é evitar a poluição de códigos legados no codebase.
Apesar de ter alguma similaridade com o Gateway na verdade o Anti-corruption layer serve somente para lidar com intenções externas na camada de negócio.   

Todo as requisições são interpretadas, filtradas, traduzidas e finalmente delegada para seu destino.  

Para resolver esse problema é implementado o design pattern Chain of Responsibility.  

Esse padrão é composto por uma pipeline, handlers e por fim o seu destino.  

Cada handler serve para manipular uma mensagem e identificar se ela corresponde as suas expectativas. Se isso ocorrer a mesma tomará uma ação e então invocará um tradutor que delegará para um repository, service ou algum ponto de entrada da camada de aplicação. 
Se não dar match e então delega para o sucessor handler e assim sucessivamente.  

Pipeline é por onde a mensagem transita.  

Downstream o parceiro que necessita de algum recurso

Upstream o parceiro que provê os recursos  

Exemplos

![Image](../../assets/sharedKernel.png?raw=true)