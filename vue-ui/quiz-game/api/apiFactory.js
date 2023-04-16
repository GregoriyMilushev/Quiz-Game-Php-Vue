
import apiClient from './apiClient';

export const api = (resource) => {

  const repositories = {
    'quote': {
      all: () => apiClient.get(`${resource}`),
      random: (ids) => apiClient.get(`${resource}/random`, {params: {ids: ids}}),
      check: (quoteId,answerId) => apiClient.get(`${resource}/check`, {params: {quote_id: quoteId, answer_id: answerId}})
    },
  };

  if (Object.prototype.hasOwnProperty.call(repositories, resource)) {
    return repositories[resource];
  }

  throw new Error(`API repository for resource "${resource}" doesn't exist.`);
};
