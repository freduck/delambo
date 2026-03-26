const getResults = async (answerId) => {
  // 1. Fetch the user's submitted answers
  const userAnswer = await Answer.findById(answerId);
  
  // 2. Fetch the actual exam to get the correct keys
  const exam = await Exam.findOne({ title: userAnswer.title });

  let score = 0;
  const detailedResults = userAnswer.answer.map(submitted => {
    // Find the original question in the exam schema
    const originalQuestion = exam.questions.id(submitted.questionId);
    
    const isCorrect = originalQuestion.correct === submitted.answer;
    if (isCorrect) score++;

    return {
      question: originalQuestion.question,
      userAnswer: submitted.answer,
      correctAnswer: originalQuestion.correct,
      isCorrect: isCorrect
    };
  });

  return {
    score: score,
    totalQuestions: exam.questions.length,
    percentage: (score / exam.questions.length) * 100,
    details: detailedResults
  };
};



