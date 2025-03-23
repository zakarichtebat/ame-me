<template>
  <div class="cgvs-container">
    <h1 class="cgvs-title">AME MAINTENANCE & ENGINEERING CONDITIONS GENERALES DE VENTE ET SERVICES</h1>
    
    <div class="cgvs-navigation">
      <div class="search-box">
        <input v-model="searchQuery" placeholder="Rechercher dans les CGVS..." @input="filterSections" />
      </div>
      
      <div class="toc">
        <h3>Sommaire</h3>
        <ul>
          <li v-for="(section, index) in filteredSections" :key="index">
            <a href="#" @click.prevent="scrollToSection(section.id)">{{ section.title }}</a>
          </li>
        </ul>
      </div>
    </div>
    
    <div class="cgvs-content">
      <section v-for="(section, index) in sections" :key="index" :id="section.id" class="cgvs-section">
        <h2>{{ section.title }}</h2>
        <div v-html="section.content"></div>
      </section>
      
      <div class="cgvs-footer">
        <p>Nador, le 08.08.2020</p>
        <div class="action-buttons">
          <button @click="printCGVS" class="btn btn-primary">Imprimer</button>
          
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AnimatedCGVSComponent',
  data() {
    return {
      searchQuery: '',
      sections: [
        {
          id: 'champ-application',
          title: '1. Champ d\'application',
          content: `
            <p>Les présentes Conditions Générales de Vente et de Services sont applicables à toute commande et demande de Produits ou Services effectuée par le Client auprès de AME Maintenance & Engineering, à toute proposition commerciale établie par l'AME Maintenance & Engineering et à toute commande du Client.</p>
            <p>Toute commande de Produits et Services adressée à AME Maintenance & Engineering emporte l'acceptation expresse et sans réserve par le Client des présentes Conditions Générales de Vente et de Services et renonciation de sa part à l'application de ses propres conditions générales d'achat, d'intervention ou de sous-traitance.</p>
            <p>Toute dérogation prévue dans la commande ne pourra être considérée comme acceptée que si elle fait l'objet d'un accord écrit du vendeur.</p>
          `
        },
        {
          id: 'definitions',
          title: '2. Définitions',
          content: `
            <p>Dans les présentes conditions générales de vente et de services sont entendus par :</p>
            <p><strong>« AME Maintenance & Engineering » ou « Vendeur » ou « AME »</strong> : AME Maintenance & Engineering S.A.R.L -AU, société à responsabilité limitée à l'associe unique au capital social de 100.000,00 Dirhams, dont le siège social est situé à Lot Alomrane N°2319, 62702 Selouane, Nador, enregistrée au Registre du Commerce sous le numéro 20273 Nador.</p>
            <p><strong>« Client » ou « Acheteur » ou « Distributeur » ou « Partenaire »</strong> : toute personne morale de droit public ou de droit privé ayant conclu un contrat avec AME Maintenance and Engineering pour l'achat de Produits et la réalisation des Services.</p>
          `
        },
        {
          id: 'transport',
          title: '3. Transport',
          content: `
            <p>Le transport des fournitures peut être assuré au mieux par le vendeur mais toujours pour le compte, aux frais et risques du client.</p>
          `
        },
        {
          id: 'marchandises',
          title: '4. Marchandises',
          content: `
            <p>La maintenance et la réparation sont effectuées chez le client. Les composants ajoutés sont installés et assemblés sur place. Les travaux d'ingénierie ne sont livrés que si les composants conçus sont conformes aux exigences de l'offre. Les prestations et compléments en dehors de la description des travaux dans l'offre ne fera pas effectués en seulement dans le cas d'une commande écrite et signée.</p>
          `
        },
        {
          id: 'retour',
          title: '5. Retour',
          content: `
            <p>Aucun retour n'est accepté, sauf cas d'une erreur de commande signalée dans les huit jours suivant la réception, sous réserve qu'il s'agisse de produits catalogués. Dans ce cas, les ports aller et retour et une participation aux frais de 20% minimum seront déduits des marchandises.</p>
          `
        },
        {
          id: 'commande-offre',
          title: '6. Commande et Offre',
          content: `
            <p>Toute commande Hors Droits de Douane et Hors T.V.A doit être présentée avec une copie originale du Dossier d'investissement approuvé par les autorités et d'une attestation d'exonération de T.V.A. libellée au nom de AME Maintenance & Engineering.</p>
            <p>Si les commandes du client est délivré sans signature et cachet du Gérant ou d'un manager ne seront pas prises en considération.</p>
            <p>Tous les accords doivent être respectés si le client a signé une offre avec un responsable ou un Manager d'AME Maintenance & Engineering.</p>
            <p>Après la réception de la commande ou demande client, le client a le droit d'annuler cette commande dans les 3 jours suivant après la réception de la commande par AME.</p>
            <p>Une offre ou une commande verbale n'est pas une offre ou une commande acceptée.</p>
            <p>L'offre n'est créée que pour une demande officielle et enregistrée par le client. Une offre est toujours valable jusqu'à 8 semaines après la réception.</p>
            <p><strong>TRAVAUX HORS CONTRAT ET MODIFICATIONS</strong></p>
            <p>Aucune modification aux plans et devis ne sera permise sans en faire une demande écrite à l'Ingénieur ou au Propriétaire.</p>
            <p>Si au cours de la construction, l'Entrepreneur est avisé de faire un changement et qu'il croit avoir droit à une rémunération supplémentaire, il doit avertir par écrit l'Ingénieur et le Propriétaire, et ne pas procéder au changement avant d'en avoir reçu l'autorisation écrite.</p>
            <p>Aucune rémunération supplémentaire ne sera payée à l'Entrepreneur pour un travail autre que celui stipulé au contrat, à moins que ces derniers n'obtiennent une autorisation écrite du Propriétaire.</p>
          `
        },
        {
          id: 'delais-paiement',
          title: '7. Délais et paiement',
          content: `
            <p>Des délais peuvent cependant être accordés aux clients demandeurs, sous réserve de rester Conforme avec les dispositions de la loi 32-10 relative aux délais de paiement et avec un plafond d'encours convenu après analyse de leur capacité financière et examen des garanties fournies.</p>
            <p>Une commande sera exécutée si le client a transféré à l'avance les 30% requis du prix d'offre convenu sur le compte bancaire d'AME Maintenance & Engineering.</p>
            <p>Après 70% d'achèvement du projet, le client est invité à transférer 30% du prix convenu sur le compte de l'entreprise.</p>
            <p>Après la délivrassions des services ou les procédures de maintenance, le projet est conclu avec un rapport de réception. Ensuite, le client est invité à transférer le montant restant de 40% sur le compte de l'entreprise maximum après 30 jours de réception de la facture.</p>
            <p>Le paiement en espèces est accepté avec un reçu et un cachet du service des achats d'AME.</p>
            <p>Une commande sera acceptée si le contractant n'a pas communiqué de refus de commande dans les 2 semaines suivant la réception de la commande.</p>
            <p>Pour tout paiement à 30 jours au moins, le paiement par virement ou chèque est impératif. Dans tous les autres cas, le moyen de paiement adopté doit autoriser une mobilisation immédiate de notre créance.</p>
          `
        },
        {
          id: 'protection-consommateur',
          title: '8. Protection du consommateur final',
          content: `
            <p>Le Distributeur/Client/Partenaire s'engage à respecter la loi 31-08 édictant des mesures de protection du consommateur, de telle sorte que la société AME Maintenance and Engineering ne soit pas inquiétée de tout recours qui pourrait être fait à son encontre au cas où sa responsabilité serait recherchée à ce titre.</p>
          `
        },
        {
          id: 'penalites-retard',
          title: '9. Pénalités pour retard de paiement',
          content: `
            <p>En cas de non-respect d'une échéance correspondant aux délais de paiement définis par la loi 3-10, des indemnités de retard seront appliquées et facturées sans formalité préalable. Le calcul des intérêts de retard sera effectué prorata temporisé sur la base du taux directeur de Bank Al Maghrib (BAM) +7%, sans être inférieur à 10 % HT. Ces intérêts seront facturés après encaissement de la facture en retard et conformément aux dispositions de la loi 32-10.</p>
          `
        },
        {
          id: 'contestations',
          title: '10. Contestations et loi applicable',
          content: `
            <p>En cas de contestations relatives à l'interprétation l'exécution de contrat intervenu, les tribunaux de Nador ou Oujda sont compétents. Toute question relative aux présentes conditions générales de vente ainsi qu'aux ventes qu'elles régissent, et qui ne serait pas traitée par les présentes stipulations contractuelles, sera régie par la loi marocaine.</p>
          `
        }
      ],
      filteredSections: []
    };
  },
  created() {
    this.filteredSections = [...this.sections];
    
    // Ajouter les sections supplémentaires
    this.sections.push(
      {
        id: 'remises',
        title: '11. Remises',
        content: `
          <p>Un barème de vente révisable chaque année, définit les remises applicables en fonction du chiffre d'affaires ou pour des quantités importantes approvisionnées familles de produits.</p>
        `
      },
      {
        id: 'delais',
        title: '12. Délais',
        content: `
          <p>Nos délais de livraison sont fournis à titre indicatif ; ceux-ci dépendant notamment de la disponibilité des transporteurs et de l'ordre d'arrivée des commandes, leur inobservation ne peut donner lieu ni à pénalités ni à des dommages et intérêts.</p>
          <p>AME Maintenance & Engineering est dégagée de tout engagement relatif aux délais de livraison si le Client n'est pas à jour de ses obligations envers elle, notamment :</p>
          <p>En ce qui concerne les délais de paiement de la commande en cours ou des factures échues, notamment en ce qui concerne les demandes d'acomptes,</p>
          <p>Ou les demandes de renseignements (spécifications techniques ou justification de qualification technique) à fournir par le Client, ainsi qu'en cas de force majeure ou en cas de circonstances hors de son contrôle, telles que, notamment, grèves, gel, incendie, tempête, inondation, épidémie, difficultés d'approvisionnement.</p>
        `
      },
      {
        id: 'propriete-intellectuelle',
        title: '14. Propriété intellectuelle – Internet',
        content: `
          <p>Tous les documents techniques remis ou transmis de quelque façon que ce soit (notamment par INTERNET) aux clients demeurent la propriété exclusive de la société AME Maintenance and Engineering ou de ses fournisseurs, seuls titulaires des droits de propriété intellectuelle et industrielle sur ces documents, et doivent, le cas échéant, lui être rendus à sa demande.</p>
          <p>Les clients s'engagent à ne faire aucun usage de ces documents ou représentations, susceptible de porter atteinte aux droits de propriété industrielle ou intellectuelle de la société AME ou de ses fournisseurs, et s'engagent à ne les divulguer à aucun tiers. En particulier, toute diffusion, notamment par le biais d'Internet, ne pourra se faire qu'avec l'autorisation préalable et écrite de la société AME Maintenance and Engineering ou de ses fournisseurs.</p>
        `
      },
      {
        id: 'force-majeure',
        title: '15. Force majeure',
        content: `
          <p>Sont considérés comme cas de force majeure ou cas fortuits, les événements indépendants de la volonté des parties, qu'elles ne pouvaient raisonnablement être tenues de prévoir, et qu'elles ne pouvaient raisonnablement éviter ou surmonter, dans la mesure où leur survenance rend totalement impossible l'exécution des obligations.</p>
          <p>Sont notamment assimilés à des cas de force majeure ou fortuits déchargeant la société AME Maintenance and Engineering de son obligation de livrer dans les délais initialement prévus : les grèves de la totalité ou d'une partie du personnel de la société Maintenance and Engineering ou de ses sous-traitants habituels, l'incendie, l'inondation, la guerre, les épidémies, l'impossibilité d'être approvisionné pour une cause non imputable à la société Maintenance and Engineering.</p>
          <p>Dans de telles circonstances, le contrat liant la société AME Maintenance and Engineering et le client sera suspendu, sans que le client puisse prétendre à des dommages et intérêts à ce titre.</p>
        `
      }
    );
    
    // Mettre à jour la liste filtrée
    this.filteredSections = [...this.sections];
  },
  methods: {
    scrollToSection(sectionId) {
      const element = document.getElementById(sectionId);
      if (element) {
        element.scrollIntoView({ behavior: 'smooth' });
      }
    },
    filterSections() {
      if (!this.searchQuery.trim()) {
        this.filteredSections = [...this.sections];
        return;
      }
      
      const query = this.searchQuery.toLowerCase();
      this.filteredSections = this.sections.filter(section => {
        return section.title.toLowerCase().includes(query) || 
               section.content.toLowerCase().includes(query);
      });
    },
    printCGVS() {
      window.print();
    },
    downloadPDF() {
      // Dans une application réelle, appel vers un service de génération de PDF
      alert('Téléchargement du PDF en cours...');
    }
  }
};
</script>

<style scoped>
.cgvs-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 2rem;
  background-color: #ffffff;
  color: #333333;
  font-family: 'Figtree', sans-serif;
}

.cgvs-title {
  font-size: 2rem;
  color: #2842c8;
  text-align: center;
  margin-bottom: 2rem;
  padding-bottom: 1rem;
  border-bottom: 2px solid #2842c8;
}

.cgvs-navigation {
  display: flex;
  flex-direction: column;
  margin-bottom: 3rem;
  padding: 1.5rem;
  background-color: #f8f9fa;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
}

.search-box {
  margin-bottom: 1.5rem;
}

.search-box input {
  width: 100%;
  padding: 0.75rem;
  border: 1px solid #e2e8f0;
  border-radius: 4px;
  font-size: 1rem;
  transition: all 0.3s ease;
}

.search-box input:focus {
  outline: none;
  border-color: #2842c8;
  box-shadow: 0 0 0 3px rgba(40, 66, 200, 0.1);
}

.toc h3 {
  font-size: 1.25rem;
  color: #2842c8;
  margin-bottom: 1rem;
}

.toc ul {
  list-style: none;
  padding: 0;
  margin: 0;
}

.toc li {
  margin-bottom: 0.5rem;
}

.toc a {
  color: #333333;
  text-decoration: none;
  transition: color 0.3s ease;
  display: block;
  padding: 0.5rem 0;
}

.toc a:hover {
  color: #2842c8;
  text-decoration: underline;
}

.cgvs-content {
  line-height: 1.6;
}

.cgvs-section {
  margin-bottom: 3rem;
  padding-bottom: 2rem;
  border-bottom: 1px solid #e2e8f0;
}

.cgvs-section h2 {
  font-size: 1.5rem;
  color: #2842c8;
  margin-bottom: 1rem;
}

.cgvs-section h3 {
  font-size: 1.25rem;
  color: #333333;
  margin: 1.5rem 0 1rem;
}

.cgvs-section h4 {
  font-size: 1.1rem;
  color: #333333;
  margin: 1rem 0 0.75rem;
}

.cgvs-section p {
  margin-bottom: 1rem;
}

.cgvs-section strong {
  font-weight: 600;
}

.cgvs-footer {
  margin-top: 4rem;
  padding-top: 2rem;
  border-top: 2px solid #2842c8;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.cgvs-footer p {
  font-weight: 600;
}

.action-buttons {
  display: flex;
  gap: 1rem;
}

.btn {
  padding: 0.75rem 1.5rem;
  border: none;
  border-radius: 4px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
}

.btn-primary {
  background-color: #2842c8;
  color: white;
}

.btn-primary:hover {
  background-color: #1e36a7;
  box-shadow: 0 4px 6px rgba(40, 66, 200, 0.2);
}

.btn-secondary {
  background-color: #e2e8f0;
  color: #2842c8;
}

.btn-secondary:hover {
  background-color: #d1d8e5;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

@media (max-width: 768px) {
  .cgvs-footer {
    flex-direction: column;
    gap: 1rem;
    text-align: center;
  }
  
  .action-buttons {
    width: 100%;
    justify-content: center;
  }
}

@media print {
  .cgvs-navigation,
  .action-buttons {
    display: none;
  }
  
  .cgvs-container {
    padding: 0;
    margin: 0;
  }
  
  .cgvs-title {
    text-align: center;
  }
  
  .cgvs-section {
    page-break-inside: avoid;
  }
}

@media (prefers-color-scheme: dark) {
  .cgvs-container {
    background-color: #1e293b;
    color: #f8f9fa;
  }
  
  .cgvs-title {
    color: #60a5fa;
    border-bottom-color: #60a5fa;
  }
  
  .cgvs-navigation {
    background-color: #0f172a;
  }
  
  .search-box input {
    background-color: #334155;
    border-color: #475569;
    color: #f8f9fa;
  }
  
  .search-box input:focus {
    border-color: #60a5fa;
    box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.2);
  }
  
  .toc h3 {
    color: #60a5fa;
  }
  
  .toc a {
    color: #f8f9fa;
  }
  
  .toc a:hover {
    color: #60a5fa;
  }
  
  .cgvs-section {
    border-bottom-color: #334155;
  }
  
  .cgvs-section h2 {
    color: #60a5fa;
  }
  
  .cgvs-section h3,
  .cgvs-section h4 {
    color: #f8f9fa;
  }
  
  .cgvs-footer {
    border-top-color: #60a5fa;
  }
  
  .btn-primary {
    background-color: #60a5fa;
    color: #0f172a;
  }
  
  .btn-primary:hover {
    background-color: #3b82f6;
  }
  
  .btn-secondary {
    background-color: #334155;
    color: #f8f9fa;
  }
  
  .btn-secondary:hover {
    background-color: #475569;
  }
}
</style> 