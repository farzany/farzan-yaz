import ReactDOM from 'react-dom/client';
import Alert from '@mui/material/Alert';
import Select from '@mui/material/Select';
import Button from '@mui/material/Button';
import Snackbar from '@mui/material/Snackbar';
import MenuItem from '@mui/material/MenuItem';
import Skeleton from '@mui/material/Skeleton';
import TextField from '@mui/material/TextField';
import AlertTitle from '@mui/material/AlertTitle';
import InputLabel from '@mui/material/InputLabel';
import React, { useState, useEffect } from 'react';
import DeleteIcon from '@mui/icons-material/Delete';
import FormControl from '@mui/material/FormControl';
import FormHelperText from '@mui/material/FormHelperText';
import PlaylistAddIcon from '@mui/icons-material/PlaylistAdd';

function ResumeAssistant() {
  const helperTextStyle = { sx: { marginLeft: '1px', marginTop: '5px' } };
  const defaultResume = { current: '', years: '0', softSkills: '', hardSkills: '', experiences: [], education: '' };
  const [resumeInfo, setResumeInfo] = useState(defaultResume);
  const [generatedResume, setGeneratedResume] = useState(null);
  const [generatingResume, setGeneratingResume] = useState(false);
  const [experiencesCount, setExperiencesCount] = useState(1);
  const [experiences, setExperiences] = useState({ 0: { duration: '1' } });
  const [snackbarMessage, setSnackbarMessage] = useState(null);
  const [openSnackbar, setOpenSnackbar] = useState(false);
  const [errors, setErrors] = useState({ current: { error: false, message: '' } });

  const handleSnackbar = (message) => {
    setSnackbarMessage(message);
    setOpenSnackbar(true);
    setTimeout(() => {
      setOpenSnackbar(false);
    }, 5000)
  };

  const handleAddExperience = () => {
    experiences[experiencesCount] = { duration: '1' };
    handleSnackbar(`Added Experience #${experiencesCount + 1}`)
    setExperiencesCount(experiencesCount + 1)
  };

  const handleRemoveExperience = () => {
    delete experiences[experiencesCount - 1];
    handleSnackbar(`Removed Experience #${experiencesCount}`)
    setExperiencesCount(experiencesCount - 1)
  }

  const onSubmit = async () => {
    setGeneratedResume(null);
    setGeneratingResume(true);

    if (resumeInfo.current === '') {
      setErrors({ current: { error: true, message: 'This field is required!' } });
      const current = document.getElementById('data-info');
      current.scrollIntoView(true, { behavior: 'smooth' });
      handleSnackbar('Please fill in the minimum required fields.');
      setGeneratingResume(false);
      return;
    }

    setTimeout(() => {
      const results = document.getElementById('final-results');
      results.scrollIntoView(true, { behavior: 'smooth' });
    }, 0);

    resumeInfo.experiences = [];
    Object.keys(experiences).map((key) => {
      resumeInfo.experiences.push(`Experience: ${experiences[key].duration} years as a ${experiences[key].position}. At this position, I did the following: ${experiences[key].skills}.\n`);
    })
  
    fetch('resume-assistant/create', {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'url': 'resume-assistant/create',
        "X-CSRF-Token": document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      "body": JSON.stringify(resumeInfo),
    })
    .then((response) => {
      return response.json();
    })
    .then(data => {
      setGeneratedResume(data.data);
      setGeneratingResume(false);
    })
    .catch(() => {
      handleSnackbar('Failed to connect to the OpenAI model. Feel free to try until it works.');
    });
  };

  return (
    <div className="w-full h-max relative">
        <div id="description" className="pb-8">
          <h1 className="font-bold text-5xl leading-10 pt-8 pb-6">
              AI Resume Assistant <span>📄</span>
          </h1>
          <p className="text-lg leading-7 pt-2">
            Powered by OpenAi's GPT-3, AI Resume Assistant helps you create a professional resume by taking basic information about your experiences. Simply enter your work history, education, and skills, and the AI will generate polished resume content that accurately reflects your qualifications. The generated content can then be read and customized to ensure it fully represents you and your career goals.
          </p>
        </div>
        {/* <div id="sample" className="pb-8">
          <Button variant="contained" fullWidth disableElevation disabled={generatingResume}>Want inspiration? Check out my resume that I created using this tool!</Button>
        </div> */}
        <Alert severity="info" id="data-info">
          <AlertTitle>What happens to my information?</AlertTitle>
          Your information is never stored on our servers. It is simply transmitted to the OpenAI model which is responsible for generating your resume. This means that once the page refreshes or you lose connection, your information is wiped.
        </Alert>
        <div id="basic-career-information">
          <h2 className="body font-semibold pt-8 pb-7 text-blue-500">Basic Career Information</h2>
          <div className="flex gap-5 mb-5">
            <TextField
              error={errors['current'].error}
              FormHelperTextProps={helperTextStyle}
              fullWidth
              helperText={errors['current'].error ? errors['current'].message : 'Examples: Full-stack Software Developer, Highschool senior, Grocery store cashier.'}
              id="current"
              label="Career Title / Current Position"
              onBlur={(value) => {resumeInfo.current = value.target.value;}}
              onChange={() => {setErrors({ current: { error: false, message: 'This field is required!' } });}}
              placeholder="Full-stack Software Developer"
              variant="outlined"
            />
            <FormControl sx={{ width: '200px' }}>
            <InputLabel id="years-label">Experience</InputLabel>
              <Select
                labelId="years-label"
                id="years"
                label="Experience"
                defaultValue={0}
                onBlur={(value) => {resumeInfo.years = String(value.target.value);}}
              >
                <MenuItem value={0}>None yet</MenuItem>
                <MenuItem value={1}>1 Year</MenuItem>
                {[...Array(8).keys()].map(year => (
                  <MenuItem value={year+2}>{year+2} Years</MenuItem>
                ))}
                <MenuItem value={'10+'}>10+ Years</MenuItem>
              </Select>
              <FormHelperText sx={{ marginLeft: '1px', marginTop: '5px' }}>Round to a year.</FormHelperText>
            </FormControl>
          </div>
          <TextField
            FormHelperTextProps={helperTextStyle}
            fullWidth
            helperText="Provide any information related to your education that you think is appropriate."
            id="education"
            label="Education"
            onBlur={(value) => {resumeInfo.education = value.target.value;}}
            placeholder="Fourth-year Computer Science student at McMaster University. 3.9/4.0 GPA, Honors List."
            variant="outlined"
          />
        </div>
        <div id="soft-skills">
          <h2 className="body font-semibold pt-8 pb-3 text-blue-500">Soft Skills</h2>
          <p className="text-lg leading-7 pb-5">Soft skills refer to personal attributes or personality traits that are not directly related to technical skills. Examples include communication, teamwork, adaptability, problem-solving, and time management.</p>
          <TextField
            FormHelperTextProps={helperTextStyle}
            fullWidth
            helperText="Provide a comma-seperated or point-form list of soft skills."
            id="soft-skills"
            multiline
            onBlur={(value) => {resumeInfo.softSkills = value.target.value;}}
            placeholder="Committed to contributing to a positive work culture, skilled in teamwork and creating interpersonal relationships, etc."
            rows={5}
            variant="outlined"
          />
        </div>
        <div id="hard-skills">
          <h2 className="body font-semibold pt-8 pb-3 text-blue-500">Technical Skills</h2>
          <p className="text-lg leading-7 pb-5">List any career-related skills that you may have. Examples include programming languages and frameworks, experience in specific software (Microsoft Office, Adobe products, etc.), and experience with machines (Fork-lift, Self-checkout kiosks, etc.).</p>
          <TextField
            FormHelperTextProps={helperTextStyle}
            fullWidth
            helperText="Provide a comma-seperated or point-form list of technical skills."
            id="hard-skills"
            multiline
            onBlur={(value) => {resumeInfo.hardSkills = value.target.value;}}
            placeholder="Fork-lift certified, experienced with the Laravel framework, Smart-serve licensed, etc."
            rows={5}
            variant="outlined"
          />
        </div>
        <div id="experiences">
          <h2 className="body font-semibold pt-8 pb-3 text-blue-500">Professional Experience</h2>
          <p className="text-lg leading-7">List any career-related experiences that you may have. If you're just starting out, it may be okay to include work experience that doesn't directly align with your career. Provide as much detail as you can think of about important projects you've worked on, your responsibilities, and the skills you've learned. The AI has no idea what you've been upto, so give it a quick summary of your experience.</p>
          {[...Array(experiencesCount).keys()].map((count) => (
            <div id="experience">
              <div className="flex gap-10 justify-between content-center">
                <p className="text-xl font-medium my-5">Experience #{count+1}</p>
              </div>
              <div className="flex gap-5 mb-5">
                <TextField
                  FormHelperTextProps={helperTextStyle}
                  fullWidth
                  helperText="Provide an accurate title for your position or experience."
                  id="position"
                  label="Position Title"
                  onBlur={(value) => {experiences[count].position = value.target.value;}}
                  placeholder="Junior Software Developer Intern"
                  defaultValue={experiences[count]?.position}
                  rows={5}
                  variant="outlined"
                />
                <FormControl sx={{ width: '200px' }}>
                  <InputLabel id="duration-label">Duration</InputLabel>
                  <Select
                    id="duration"
                    label="Duration"
                    labelId="duration-label"
                    defaultValue={experiences[count]?.duration}
                    onBlur={(value) => {experiences[count].duration = String(value.target.value);}}
                  >
                    <MenuItem value={1}>1 Year</MenuItem>
                    {[...Array(8).keys()].map(year => (
                      <MenuItem value={year+2}>{year+2} Years</MenuItem>
                    ))}
                    <MenuItem value={'10+'}>10+ Years</MenuItem>
                  </Select>
                  <FormHelperText sx={{ marginLeft: '1px', marginTop: '5px' }}>Round to a year.</FormHelperText>
                </FormControl>
              </div>
              <TextField
                FormHelperTextProps={helperTextStyle}
                fullWidth
                helperText="Provide a comma-seperated or point-form list of experiences for this position."
                id="skills"
                multiline
                onBlur={(value) => {experiences[count].skills = value.target.value;}}
                placeholder="Worked on a web-application with a Laravel framework and React front-end, frequently took on leadership roles during meetings and technical demonstrations, dedicated to unit and scaling testing, etc."
                rows={5}
                variant="outlined"
                defaultValue={experiences[count]?.skills}
              />
            </div>
          ))}
          <div className="flex gap-5 mt-5">
            <Button variant="outlined" onClick={handleAddExperience} startIcon={<PlaylistAddIcon />}>Add Experience</Button>
            {experiencesCount > 1 ? (
              <Button variant="outlined" onClick={handleRemoveExperience} startIcon={<DeleteIcon />}>Remove Experience</Button>
            ) : null}
          </div>
        </div>
        <div className="pt-12">
          <Button variant="contained" onClick={onSubmit} fullWidth disableElevation disabled={generatingResume}>Generate Resume</Button>
        </div>
        <div id="final-results" className="pt-8">
          {generatedResume ? (
            <>
              <div id="summary" className="pt-5">
                <div className="flex justify-between content-center">
                  <h2 className="body font-semibold py-3 text-blue-500">Summary of Qualifications</h2>
                  <div id="options" className="my-auto">
                    <Button variant="outlined" onClick={() => {navigator.clipboard.writeText(generatedResume.summary); handleSnackbar('Copied Summary of Qualifications!');}}>Copy</Button>
                  </div>
                </div>
                <TextField 
                  defaultValue={generatedResume.summary.slice(1).trim()}
                  fullWidth
                  id="summary"
                  multiline
                  variant="outlined"
                />
              </div>
              <div id="education" className="pt-5" hidden={resumeInfo.education === ''}>
                <div className="flex justify-between content-center">
                  <h2 className="body font-semibold py-3 text-blue-500">Education</h2>
                  <div id="options" className="my-auto">
                    <Button variant="outlined" onClick={() => {navigator.clipboard.writeText(generatedResume.education); handleSnackbar('Copied Education Summary!');}}>Copy</Button>
                  </div>
                </div>
                <TextField 
                  defaultValue={generatedResume.education.slice(1).trim()}
                  FormHelperTextProps={helperTextStyle}
                  fullWidth
                  helperText="When displaying your education on a resume, it's best to keep it point-form and outline only the important details. This result is only for inspiration."
                  id="education"
                  multiline
                  variant="outlined"
                />
              </div>
              <div id="experience" className="pt-5">
                <div className="flex justify-between content-center">
                  <h2 className="body font-semibold pt-3 text-blue-500">Professional Experience</h2>
                </div>
                {generatedResume.experiences.map(experience => (
                  <div className="mb-20">
                    <div className="flex gap-10 justify-between content-center">
                      <p className="text-xl font-medium py-3">{experiences[generatedResume.experiences.indexOf(experience)].position || 'Potential Template'}</p>
                      <div id="options" className="my-auto">
                        <Button variant="outlined" onClick={() => {navigator.clipboard.writeText(experience); handleSnackbar(`Copied ${experiences[generatedResume.experiences.indexOf(experience)].position || 'Potential Template'} Summary!`);}}>Copy</Button>
                      </div>
                    </div>
                    <TextField 
                      defaultValue={experience.slice(1).trim()}
                      fullWidth
                      id="experience"
                      multiline
                      variant="outlined"
                    />
                  </div>
                ))}
              </div>
            </>
          ) : generatingResume ? (
            <>
              <Skeleton variant="text" height={75} />
              <Skeleton variant="rounded" height={200} />
              {resumeInfo.education !== '' ? (
                <>
                  <Skeleton variant="text" height={75} />
                  <Skeleton variant="rounded" height={150} />
                </>
              ) : null}
              <Skeleton variant="text" height={75} />
              <Skeleton variant="rounded" height={150} />
              {Object.keys(experiences).map(() => {
                <Skeleton sx={{ marginTop: '10px' }} variant="rounded" height={150} />
              })}
            </>
          ) : null}
        </div>
        <Snackbar open={openSnackbar}>
          <Alert variant="filled" severity={errors.current.error ? 'error' : 'info'} sx={{ width: '100%' }}>
            {snackbarMessage}
          </Alert>
        </Snackbar>
    </div>
  );
}

export default ResumeAssistant;

if (document.getElementById('resume-assistant')) {
  const Index = ReactDOM.createRoot(document.getElementById("resume-assistant"));

  Index.render(
    <React.StrictMode>
        <ResumeAssistant />
    </React.StrictMode>
  )
}
